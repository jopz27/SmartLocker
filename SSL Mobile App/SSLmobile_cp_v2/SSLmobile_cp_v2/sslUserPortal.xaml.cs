using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Timers;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

using Refit;
using Rg;

using SSLmobile_cp_v2.Interface;
using SSLmobile_cp_v2.Model;
using Plugin.Connectivity;
using Rg.Plugins.Popup.Services;

namespace SSLmobile_cp_v2
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class sslUserPortal : ContentPage
    {
        TimeSpan timeToDisplay;

        public string prevLockerStatus = "";

        public int penaltyFlag = 0; // 0 no penalty, 1 has penalty
        public int reservedFlag = 0; //0 no reservation, 1 has reservation
        public int reservedLockerNumber = 0; //reserved locker number 1,2,3,4
        public int ongoingFlag = 0; //1 = has ongoing usage of locker, 0 none
        public int logoutFlag = 0; //if user currently have ongoint status then logged out
        public int occupiedLockerNumber = 0; //occupied locker number 1,2,3,4
        public int firstOpenCheckFlag = 0; //0 not, 1 yes
        public int reservationWayFlag = 0; //0 = onsite, 1 = mobile
        public int reservedTimerFlag = 0; //0 not start, 1 started
        public int cancelationWay = 0; //0 onsite, 1 mobile
        public int popUpFlag = 0;
        public int confirmationCheck = 0; //check confirmation 0 during reservation and >0 means confirmed
        public int beyondTimeAllowedForReservation = 0;

        //public bool isConnected;

        //0 for mobile, 1 onsite
        public int onsiteOrMobileFlag = 0;

        //process number on how to check ongoing locker status for logout notification
        public int ongoingLogoutCheckProcess = 1;

        private List<lockerStatusResult> lockerStatuses = new List<lockerStatusResult>();
        private List<availableLocker> availableLockers = new List<availableLocker>();
        private List<userInfo> userInfos = new List<userInfo>();
        private List<operationResult> operationResults = new List<operationResult>();
        
        public int ReservationPenaltySignal = 0;

        public sslUserPortal(List<userInfo> passedUserInfos)
        {
            //value passed from main page
            userInfos = passedUserInfos;
            InitializeComponent();
            cancelBtn.IsEnabled = false;
            cancelBtn.Opacity = 0;
            
            //run constant checker for the first time
            constantChecker();

            if (ongoingFlag == 0)
            {
                accountPenaltyCheck();
            }
            onGoingCheck();

            //accountPenaltyCheck();
            //buttonChecker();
            //onGoingCheck();

            //profile
            var tgr = new TapGestureRecognizer();
            tgr.Tapped += (s, e) => OnLabelClicked(s, e);
            Profile.GestureRecognizers.Add(tgr);
        }

        //call API for locker statuses
        async Task lockerStatusApi(int operationsNumber)
        {
            //button for alert
            Button alertButton = new Button();

            try
            {
                var apiResponse = RestService.For<SslApi>(Constants.baseURL);

                //request and response stored to lockerStatuses and passes 1
                lockerStatuses = await apiResponse.GetLockerStatuses(operationsNumber);
            }
            catch (Exception ex)
            {
                //await DisplayAlert("error retrieving locker status! /n" + ex, String.Format("{0}", alertButton.Text), "OK");
            }
        }

        async Task availabilityCheckAndColorAssignment()
        {
            //clear lockers to have latest update without adding another set of list
            availableLockers.Clear();
            //button for alert
            Button alertButton = new Button();

            try
            {
                //locker 1
                if (lockerStatuses[0].lockerStatus == "available")
                {
                    //AL(Available Locker)
                    availableLocker AL = new availableLocker();
                    locker1Btn.BackgroundColor = Color.Green;
                    AL.lockerId = 1;
                    availableLockers.Add(AL);
                }
                else if (lockerStatuses[0].lockerStatus == "reserved")
                {
                    locker1Btn.BackgroundColor = Color.Orange;
                }
                else
                {
                    locker1Btn.BackgroundColor = Color.Red;
                }

                //locker 2
                if (lockerStatuses[1].lockerStatus == "available")
                {
                    //AL(Available Locker)
                    availableLocker AL = new availableLocker();
                    locker2Btn.BackgroundColor = Color.Green;
                    AL.lockerId = 2;
                    availableLockers.Add(AL);
                }
                else if (lockerStatuses[1].lockerStatus == "reserved")
                {
                    locker2Btn.BackgroundColor = Color.Orange;
                }
                else
                {
                    locker2Btn.BackgroundColor = Color.Red;
                }


                //locker 3
                if (lockerStatuses[2].lockerStatus == "available")
                {
                    //AL(Available Locker)
                    availableLocker AL = new availableLocker();
                    locker3Btn.BackgroundColor = Color.Green;
                    AL.lockerId = 3;
                    availableLockers.Add(AL);
                }
                else if (lockerStatuses[2].lockerStatus == "reserved")
                {
                    locker3Btn.BackgroundColor = Color.Orange;
                }
                else
                {
                    locker3Btn.BackgroundColor = Color.Red;
                }


                //locker 4
                if (lockerStatuses[3].lockerStatus == "available")
                {
                    //AL(Available Locker)
                    availableLocker AL = new availableLocker();
                    locker4Btn.BackgroundColor = Color.Green;
                    AL.lockerId = 4;
                    availableLockers.Add(AL);
                }
                else if (lockerStatuses[3].lockerStatus == "reserved")
                {
                    locker4Btn.BackgroundColor = Color.Orange;
                }
                else
                {
                    locker4Btn.BackgroundColor = Color.Red;
                }

            }
            catch (Exception ex)
            {
                await DisplayAlert("error retrieving locker status! /n" + ex, String.Format("{0}", alertButton.Text), "OK");
            }
        }
        
        async Task logoutClicked()
        {
            await Navigation.PopToRootAsync();
        }

        protected override bool OnBackButtonPressed()
        {
            return true;
        }

        async Task constantChecker()
        {
            generalChecks ();
            await constantUserBehaviorChecker();
            Device.StartTimer(TimeSpan.FromSeconds(3), () =>
            {
                generalChecks();
                return true;
            });
        }

        async void generalChecks()
        {
            timeCheck();
            await lockerStatusApi(1);
            await availabilityCheckAndColorAssignment();
            await constantUserBehaviorChecker();
            await buttonChecker();
        }

        void timeCheck()
        {
            //if beyond 9pm can't reserve anymore
            TimeSpan ninePM = new TimeSpan(21, 0, 0);
            TimeSpan twelvePM = new TimeSpan(21, 0, 0);

            if ((DateTime.Now.DayOfWeek == DayOfWeek.Monday ||
                DateTime.Now.DayOfWeek == DayOfWeek.Tuesday ||
                DateTime.Now.DayOfWeek == DayOfWeek.Wednesday ||
                DateTime.Now.DayOfWeek == DayOfWeek.Thursday ||
                DateTime.Now.DayOfWeek == DayOfWeek.Friday) &&
                DateTime.Now.TimeOfDay >= ninePM)
            {
                beyondTimeAllowedForReservation = 1;
            }
            else if (DateTime.Now.DayOfWeek == DayOfWeek.Saturday && DateTime.Now.TimeOfDay >= twelvePM)
            {
                beyondTimeAllowedForReservation = 1;
            }
            else beyondTimeAllowedForReservation = 0;
        }

        async Task constantUserBehaviorChecker()//checks if the user reserved on site
        {
            //locker 1 check
            if (lockerStatuses.Count == 4)
            {
                if (lockerStatuses[0].lockerIdNumber == userInfos[0].idNumber)
                {
                    if (lockerStatuses[0].lockerStatus == "reserved")
                    {
                        prevLockerStatus = "reserved";
                        reservedLockerNumber = 1;
                        reservedFlag = 1;
                        if (reservedTimerFlag == 0) await reservationTimer();
                    }
                    else
                    {
                        reservedFlag = 0;
                    }

                    if (lockerStatuses[0].lockerStatus == "occupied")
                    {
                        prevLockerStatus = "occupied";
                        occupiedLockerNumber = 1;
                        ongoingFlag = 1;
                    }
                }
                //locker 2 check
                else if (lockerStatuses[1].lockerIdNumber == userInfos[0].idNumber)
                {
                    if (lockerStatuses[1].lockerStatus == "reserved")
                    {
                        prevLockerStatus = "reserved";
                        reservedLockerNumber = 2;
                        reservedFlag = 1;
                        if (reservedTimerFlag == 0) await reservationTimer();
                    }
                    else
                    {
                        reservedFlag = 0;
                    }

                    if (lockerStatuses[1].lockerStatus == "occupied")
                    {
                        prevLockerStatus = "occupied";
                        occupiedLockerNumber = 2;
                        ongoingFlag = 1;
                    }
                }
                //locker 3 check
                else if (lockerStatuses[2].lockerIdNumber == userInfos[0].idNumber)
                {
                    if (lockerStatuses[2].lockerStatus == "reserved")
                    {
                        prevLockerStatus = "reserved";
                        reservedLockerNumber = 3;
                        reservedFlag = 1;
                        if (reservedTimerFlag == 0) await reservationTimer();
                    }
                    else
                    {
                        reservedFlag = 0;
                    }

                    if (lockerStatuses[2].lockerStatus == "occupied")
                    {
                        prevLockerStatus = "occupied";
                        occupiedLockerNumber = 3;
                        ongoingFlag = 1;
                    }
                }
                //locker 4 check
                else if (lockerStatuses[3].lockerIdNumber == userInfos[0].idNumber)
                {
                    if (lockerStatuses[3].lockerStatus == "reserved")
                    {
                        prevLockerStatus = "reserved";
                        reservedLockerNumber = 4;
                        reservedFlag = 1;
                        if (reservedTimerFlag == 0) await reservationTimer();
                    }
                    else
                    {
                        reservedFlag = 0;
                    }

                    if (lockerStatuses[3].lockerStatus == "occupied")
                    {
                        prevLockerStatus = "occupied";
                        occupiedLockerNumber = 4;
                        ongoingFlag = 1;
                    }
                }
                return;
            }
            else return;
        }
        
        async void canceledOnSiteCheck()
        {
            Button alertButton = new Button();
            if (reservedFlag == 1 && cancelationWay == 0)
            {
                if (lockerStatuses[reservedLockerNumber - 1].lockerStatus == "available")
                {
                    reservedFlag = 0;
                    await DisplayAlert("Reservation Canceled On-site!", String.Format("{0}", alertButton.Text), "OK");
                    return;
                }
                else return;
            }
            else return;
        }

        async Task buttonChecker()
        {
            //reserve button behavior
            if (penaltyFlag == 1 || ongoingFlag == 1 || reservedFlag == 1 || beyondTimeAllowedForReservation == 1) reserveBtn.IsEnabled = false;
            else reserveBtn.IsEnabled = true;

            if (ongoingFlag == 1)
            {
                //cancel button
                cancelBtn.IsEnabled = false;
                cancelBtn.Opacity = 0;
                //reserved button
                reserveBtn.IsEnabled = false;
                //check ongoing is logout while the application is open
                await ongoingLogoutCheck();
                //or constantly check if the reservation is confirmed on site
                await reservationConfirmationCheck();
                //no reservation cuz user has ongoing
                reservedFlag = 0;
            }
            

            if (reservedFlag == 1)
            {
                //cancel button details
                cancelBtn.Opacity = 100;
                cancelBtn.IsEnabled = true;
                //then constantly check if it is canceled on site.
                canceledOnSiteCheck();
                
                //no ongoing
                ongoingFlag = 0;
            }

            if (reservedFlag == 0)
            {
                //cancel button details
                cancelBtn.IsEnabled = false;
                cancelBtn.Opacity = 0;
            }
        }

        async Task reservationConfirmationCheck()
        {
            Button alertButton = new Button();
            if (reservedLockerNumber == 0) return;
            if (lockerStatuses[reservedLockerNumber - 1].lockerStatus == "occupied" && confirmationCheck == 0)
            {
                confirmationCheck += 1;
                reservedFlag = 0; //reset to no reservation
                TimeLabel.Opacity = 0;
                await getPassCode();
                await DisplayAlert("Reservation confirmed!", String.Format("{0}", alertButton.Text), "OK");
                return;
            }
            else return;
        }

        async Task getPassCode()
        {
            Button alertButton = new Button();
            try
            {
                var apiResponse = RestService.For<SslApi>(Constants.baseURL);
                operationResults = await apiResponse.OperationPasser(userInfos[0].idNumber, 6, 0, "0");
                passCode.Text = operationResults[0].passCode;
                passCode.Opacity = 100;
            }
            catch(Exception ex)
            {
                await DisplayAlert("Error retrieving passcode!/n", String.Format("{0}", alertButton.Text), "OK");
            }
        }

        //async Task reservationCancelationOnSiteCheck()
        //{
        //    Button alertButton = new Button();
        //    if (lockerStatuses[reservedLockerNumber - 1].lockerStatus == "occupied")
        //    {
        //        reservedFlag = 0; //reset to no reservation
        //        TimeLabel.Opacity = 0;
        //        ongoingFlag = 1;
        //        await DisplayAlert("Reservation confirmed!", String.Format("{0}", alertButton.Text), "OK");
        //    }
        //    else return;
        //}

        async Task ongoingLogoutCheck()
        {
            await constantUserBehaviorChecker();
            Button alertButton = new Button();
            if (lockerStatuses[occupiedLockerNumber - 1].lockerStatus == "available")
            {
                ongoingFlag = 0;
                passCode.Text = "0";
                passCode.Opacity = 0;
                await DisplayAlert("Thank you for using Student Smart Locker!", String.Format("{0}", alertButton.Text), "OK");
                await accountPenaltyCheck();
            }
            else return;
        }

        //check on going usage of locker
        async Task onGoingCheck()
        {
            Button alertButton = new Button();
            await lockerStatusApi(1);
            await availabilityCheckAndColorAssignment();
            await constantUserBehaviorChecker();
            if (ongoingFlag == 1)
            {
                await getPassCode();
                await DisplayAlert("You have on-going locker usage!", String.Format("{0}", alertButton.Text), "OK");
                await getPassCode();
            }
            else return;
        }

        //account reservation and penalty check
        async Task accountPenaltyCheck()
        {
            Button alertButton = new Button();
            try
            {
                var apiResponse = RestService.For<SslApi>(Constants.baseURL);
                operationResults = await apiResponse.OperationPasser(userInfos[0].idNumber, 1, 0, "0");
                
                if (operationResults[0].penalty == "1")
                {
                    reserveBtn.IsEnabled = false;
                    await DisplayAlert("Your account has a penalty!", String.Format("{0}", alertButton.Text), "OK");
                    await penaltyTimer();
                }
                else
                {
                    //ReservationPenaltySignal = 0;
                    penaltyFlag = 0;
                    return;
                }
            }
            catch(Exception ex)
            {
                await DisplayAlert("Error Checking penalty!/n" + ex, String.Format("{0}", alertButton.Text), "OK");
            }
        }

        //call API for reservation of locker
        async Task reserveLockerApi(int lockerId)
        {
            //button for alert
            Button alertButton = new Button();

            //api base URL
            var apiResponse = RestService.For<SslApi>(Constants.baseURL);

            //request for reservation, response stored to reservation status and passes locker ID of an available locker
            operationResults = await apiResponse.OperationPasser(userInfos[0].idNumber, 2, lockerId, "0");

            //is returned true, means successful
            if (operationResults[0].error == "reserved")
            {
                await DisplayAlert("Someone reserved first!", String.Format("{0}", alertButton.Text), "OK");
            }
            else if (operationResults[0].reserved == true && operationResults[0].error != "reserved")
            {
                await DisplayAlert("Reservation Successful!", String.Format("{0}", alertButton.Text), "OK");
            }
            //else
            //{
            //    reservationWayFlag = 0;
            //    await DisplayAlert("Reservation Failed!", String.Format("{0}", alertButton.Text), "OK");
            //}
        }

        //penalty timer
        async Task penaltyTimer()
        {
            Button alertButton = new Button();
            TimeLabel.Opacity = 100;
            penaltyFlag = 1;

            DateTime unixToDateTime = DateTimeOffset.FromUnixTimeSeconds(Convert.ToInt64(operationResults[0].userLogoutTime)).DateTime.ToLocalTime();
            TimeSpan calculatedPenaltyInSeconds = TimeSpan.FromSeconds(Convert.ToInt64(operationResults[0].userCalculatedPenalty));

            string calculatedPenaltyInSeconds_to_DD_HH_MM_SS = calculatedPenaltyInSeconds.ToString(@"dd\:hh\:mm\:ss\:fff");
            string[] D_H_M_S = calculatedPenaltyInSeconds_to_DD_HH_MM_SS.Split(':');

            DateTime ExpectedDateToExpire = unixToDateTime.AddDays(Convert.ToInt32(D_H_M_S[0])).AddHours(Convert.ToInt32(D_H_M_S[1])).AddMinutes(Convert.ToInt32(D_H_M_S[2])).AddSeconds(Convert.ToInt32(D_H_M_S[3])).AddMilliseconds(Convert.ToInt32(D_H_M_S[4]));
            TimeSpan currentTimeBeforePenaltyExpiration = TimeSpan.FromSeconds(ExpectedDateToExpire.Subtract(DateTime.Now).TotalSeconds);

            Device.StartTimer(TimeSpan.FromSeconds(1), () =>
            {
                //if (isConnected == false) return false;
                currentTimeBeforePenaltyExpiration = currentTimeBeforePenaltyExpiration.Subtract(TimeSpan.FromSeconds(1));
                TimeLabel.Text = currentTimeBeforePenaltyExpiration.ToString(@"dd\:hh\:mm\:ss");
                if (DateTime.Now == ExpectedDateToExpire)
                {
                    penaltyFlag = 0;
                    TimeLabel.Opacity = 0;
                    return false;
                }
                else
                {
                    return true;
                }
            });
        }
        
        //reservation timer
        async Task reservationTimer()
        {
            //button for alert
            Button alertButton = new Button();
            reservedTimerFlag = 1;
            TimeLabel.Opacity = 100;

            //api base URL
            var apiResponse = RestService.For<SslApi>(Constants.baseURL);
            //if reservation is successful or true, call reservationCheck again to have a precise time based on time stamp
            operationResults = await apiResponse.OperationPasser(userInfos[0].idNumber, 1, 0, "0");
            
            DateTime unixToDateTime = DateTimeOffset.FromUnixTimeSeconds(Convert.ToInt64(operationResults[0].reservationTimeStamp)).DateTime.ToLocalTime();
            TimeSpan calculatedPenaltyInSeconds = TimeSpan.FromSeconds(Convert.ToInt64(600));

            string calculatedPenaltyInSeconds_to_DD_HH_MM_SS = calculatedPenaltyInSeconds.ToString(@"mm\:ss\:fff");
            string[] D_H_M_S = calculatedPenaltyInSeconds_to_DD_HH_MM_SS.Split(':');

            DateTime ExpectedDateToExpire = unixToDateTime.AddMinutes(Convert.ToInt32(D_H_M_S[0])).AddSeconds(Convert.ToInt32(D_H_M_S[1])).AddMilliseconds(Convert.ToInt32(D_H_M_S[0]));
            TimeSpan currentTimeBeforePenaltyExpiration = TimeSpan.FromSeconds(ExpectedDateToExpire.Subtract(DateTime.Now).TotalSeconds);
            if(DateTime.Now >= ExpectedDateToExpire)
            {
                reservedTimerFlag = 0;
                reservedFlag = 0;
                TimeLabel.Opacity = 0;
            }
            else
            {
                Device.StartTimer(TimeSpan.FromSeconds(1), () =>
                {
                    //if (isConnected == false) return false;
                    currentTimeBeforePenaltyExpiration = currentTimeBeforePenaltyExpiration.Subtract(TimeSpan.FromSeconds(1));
                    TimeLabel.Text = currentTimeBeforePenaltyExpiration.ToString(@"mm\:ss");
                    if (reservedFlag == 0)
                    {
                        reservedTimerFlag = 0;
                        reservedFlag = 0;
                        TimeLabel.Opacity = 0;
                        TimeLabel.Text = "0:00";
                        return false;
                    }

                    if (DateTime.Now >= ExpectedDateToExpire)
                    {
                        reservedTimerFlag = 0;
                        reservedFlag = 0;
                        TimeLabel.Opacity = 0;
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                });
            }
        }
        
        //when user profile is clicked
        async Task OnLabelClicked(object sender, EventArgs e)
        {
            await Navigation.PushAsync(new profilePage(userInfos));
        }

        //when reserve is clicked
        async Task reserveClicked()
        {
            //button for alert
            Button alertButton = new Button();
            reserveBtn.IsEnabled = false;
            //available lockers count
            int availableLockerCount = availableLockers.Count;

            //if no locker is available
            if (availableLockerCount == 0)
            {
                await DisplayAlert("No available locker at this time!", String.Format("{0}", alertButton.Text), "OK");
                reserveBtn.IsEnabled = true;
            }
            else
            //choose by sequence on where the user will be reserved
            {
                reservedLockerNumber = availableLockers[0].lockerId;
                await reserveLockerApi(availableLockers[0].lockerId);
            }
        }

        async void cancelClicked()
        {
            await cancelLockerReservationApi();
        }

        async Task cancelLockerReservationApi()
        {
            //button for alert
            Button alertButton = new Button();

            //api base URL
            var apiResponse = RestService.For<SslApi>(Constants.baseURL);

            try
            {
                //request for reservation, response stored to reservation status and passes locker ID of an available locker
                operationResults = await apiResponse.OperationPasser(userInfos[0].idNumber, 5, reservedLockerNumber, "0");

                //is returned true, means successful
                if (operationResults[0].reservationCancelation == "no error")
                {
                    cancelationWay = 1;
                    cancelBtn.IsEnabled = false;
                    cancelBtn.Opacity = 0;
                    reservedLockerNumber = 0;
                    reservedFlag = 0;
                    generalChecks();
                    await DisplayAlert("Reservation canceled!", String.Format("{0}", alertButton.Text), "OK");
                }
                else
                {
                    await DisplayAlert("cancellation failed!", String.Format("{0}", alertButton.Text), "OK");
                }
            }
            catch (Exception ex)
            {
                await DisplayAlert("error:"+ex, String.Format("{0}", alertButton.Text), "OK");
            }
        }
    }
}