using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Forms;

using Refit;

using SSLmobile_cp_v2.Interface;
using SSLmobile_cp_v2.Model;
using Plugin.Connectivity;
using System.Text.RegularExpressions;
using Rg.Plugins.Popup.Services;

namespace SSLmobile_cp_v2
{
	public partial class MainPage : ContentPage
	{
        public int popUpFlag = 0;
        //bool isConnected;

        protected List<userInfo> userInfos = new List<userInfo>();
        public MainPage()
        {
            InitializeComponent();
            this.InitializeComponent();

            this.BindingContext = this;
            this.IsBusy = false;

            //MessagingCenter.Subscribe<App>((App)Application.Current, "refresh", (sender) => {
            //    checkconnectivity();
            //});

            //checkconnectivity();
            checkBusyState();
        }

        //private void checkconnectivity()
        //{
        //    Device.StartTimer(TimeSpan.FromSeconds(1), () =>
        //    {
        //        isConnected = CrossConnectivity.Current.IsConnected;
        //        if (isConnected == true)
        //        {
        //            return true;
        //        }
        //        else
        //        {
        //            popUpLoading();
        //            return false;
        //        }
        //    });
        //}

        private void checkBusyState()
        {
            Device.StartTimer(TimeSpan.FromSeconds(1), () =>
            {
                if (this.IsBusy == true)
                {
                    btnLogin.IsEnabled = false;
                }
                else
                {
                    btnLogin.IsEnabled = true;
                }
                return true;
            });
        }

        //async void popUpLoading()
        //{
        //    if (isConnected == false) await PopupNavigation.PushAsync(new loadingScreen(isConnected));
        //}

        private async void signInClicked(object sender, EventArgs e)
        {
            this.IsBusy = true;
            var alertButton = sender as Button;
            string idNumberEntry = idNumberTextBox.Text;
            string passwordEntry = passwordTextBox.Text;
            if (idNumberEntry == null || idNumberEntry.Replace(" ","") == "") idNumberEntry = "";
            if (passwordEntry == null || passwordEntry.Replace(" ", "") == "") passwordEntry = "";
            //
            if (Regex.Replace(idNumberEntry, @"\s+", "") == "" || Regex.Replace(passwordEntry, @"\s+", "") == "")
            {
                await DisplayAlert("Please fill in everything!", String.Format("{0}", alertButton.Text), "OK");
                this.IsBusy = false;
            }
            else await CallLoginApi(idNumberEntry, passwordEntry);
        }

        async Task CallLoginApi(string idNumberEntry, string passwordEntry)
        {
            
            //base URL domain.com
            var apiResponse = RestService.For<SslApi>(Constants.baseURL);

            this.IsBusy = true;
            this.btnLogin.IsEnabled = false;
            //request and store user informations to userInfos list object
            userInfos = await apiResponse.Getvalidation(idNumberEntry, passwordEntry);
            
            
            this.btnLogin.IsEnabled = true;
            Button alertButton = new Button();
            this.IsBusy = false;
            //if id number = null, it means no user is retrieved
            if (userInfos[0].userError == "invalid")
            {
                this.IsBusy = false;
                await DisplayAlert("Incorrect id number or password!", String.Format("{0}", alertButton.Text), "OK");
            }
            else
            {
                this.IsBusy = false;
                await Navigation.PushAsync(new sslUserPortal(userInfos));
            }
        }
    }
}
