using Refit;
using Rg.Plugins.Popup.Pages;
using Rg.Plugins.Popup.Services;
using SSLmobile_cp_v2.Interface;
using SSLmobile_cp_v2.Model;
using System;
using System.Collections.Generic;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using SSLmobile_cp_v2;

namespace SSLmobile_cp_v2
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class changeMobileNumberPopup : PopupPage
    {
        private List<userInfo> userInfos = new List<userInfo>();
        private List<operationResult> operationResults = new List<operationResult>();

        public changeMobileNumberPopup (List<userInfo> passedUserInfos)
		{
            userInfos = passedUserInfos;
            InitializeComponent ();
		}
        private async void btnCancel_clicked(object sender, EventArgs e)
        {
            await PopupNavigation.PopAsync(true);
        }
        private async void btnOk_clicked(object sender, EventArgs e)
        {
            Button alertButton = new Button();
            //api base URL

            string NewMobileNumber = entryNewMobileNumber.Text;
            var apiResponse = RestService.For<SslApi>(Constants.baseURL);
            if (NewMobileNumber == null || NewMobileNumber.Replace(" ", "") == "") NewMobileNumber = "";
            if (NewMobileNumber == "" || entryNewMobileNumber.Text.Length < 10 || entryNewMobileNumber.Text.Length > 10)
            {
                await DisplayAlert("Invalid input!", String.Format("{0}", alertButton.Text), "OK");
            }
            else
            {
                try
                {
                    //request for reservation, response stored to reservation status and passes locker ID of an available locker
                    operationResults = await apiResponse.OperationPasser(userInfos[0].idNumber, 3, 0, entryNewMobileNumber.Text.ToString());
                    if (operationResults[0].error == "no error")
                    {
                        await DisplayAlert("Mobile number successfully changed!", String.Format("{0}", alertButton.Text), "OK");
                    }
                    else
                    {
                        await DisplayAlert("error: " + operationResults[0].error, String.Format("{0}", alertButton.Text), "OK");
                    }
                    await PopupNavigation.PopAsync(true);
                    MessagingCenter.Send<App>((App)Application.Current, "refresh");
                }
                catch(Exception ex)
                {
                    await DisplayAlert("error connecting to server: "+ex, String.Format("{0}", alertButton.Text), "OK");
                }
            }
        }
    }
}