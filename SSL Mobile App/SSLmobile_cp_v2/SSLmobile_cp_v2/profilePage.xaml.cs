using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using SSLmobile_cp_v2.Model;
using SSLmobile_cp_v2.Interface;

using Refit;
using Rg.Plugins.Popup.Services;

namespace SSLmobile_cp_v2
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class profilePage : ContentPage
	{
        private List<userInfo> userInfos = new List<userInfo>();
        private List<operationResult> operationResults = new List<operationResult>();

        public profilePage (List<userInfo> passedUserInfos)
		{
            userInfos = passedUserInfos;
			InitializeComponent ();
            MessagingCenter.Subscribe<App>((App)Application.Current, "refresh", (sender) => {
                getUpdate();
            });
        }

        protected async override void OnAppearing()
        {
            base.OnAppearing();
            getUpdate();
        }

        public async void getUpdate()
        {
            //api base URL
            var apiResponse = RestService.For<SslApi>(Constants.baseURL);

            //request user infos update
            operationResults = await apiResponse.OperationPasser(userInfos[0].idNumber, 4, 0, "0");
            profileName.Text = operationResults[0].name;
            profileIdNumber.Text = operationResults[0].currentUserIdNumber;
            profileMobileNumber.Text = "+63" + operationResults[0].mobileNumber;
        }

        public async void BtnChangeMobileNumber_clicked()
        {
            await PopupNavigation.PushAsync(new changeMobileNumberPopup(userInfos));
        }

        public async void BtnViewTransactions_clicked()
        {
            await Navigation.PushModalAsync(new ListViewTransaction(userInfos));
        }
        
        public async void changeOk_clicked()
        {

        }

    }
}