using Plugin.Connectivity;
using Rg.Plugins.Popup.Services;
using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Forms;

namespace SSLmobile_cp_v2
{
	public partial class App : Application
	{
        public bool isConnected;
        public App ()
		{
			InitializeComponent();
            MainPage = new NavigationPage(new SSLmobile_cp_v2.MainPage());
            //MainPage = new SSLmobile_cp_v2.MainPage();
            MessagingCenter.Subscribe<App>((App)Application.Current, "refresh", (sender) => {
                checkconnectivity();
            });

            checkconnectivity();
            isReachable();
        }

		protected override void OnStart ()
		{
            // Handle when your app starts

        }

		protected override void OnSleep ()
		{
			// Handle when your app sleeps
		}

		protected override void OnResume ()
		{
			// Handle when your app resumes
		}

        //async 

        async void isReachable()
        {
            var isReachable = await CrossConnectivity.Current.IsReachable("studentsmartlocker.com");
            if (isReachable == false && isConnected == true)
            {
                popUpLoading();
            }
            else return;
        }

        private void checkconnectivity()
        {
            Device.StartTimer(TimeSpan.FromSeconds(1), () =>
            {
                
                isConnected = CrossConnectivity.Current.IsConnected;
                isReachable();

                if (isConnected == true)
                {
                    return true;
                }
                else
                {
                    popUpLoading();
                    return false;
                }
            });
        }

        async void popUpLoading()
        {
            if (isConnected == false) await PopupNavigation.PushAsync(new loadingScreen(isConnected));
        }
    }
}
