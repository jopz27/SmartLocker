using Plugin.Connectivity;
using Rg.Plugins.Popup.Pages;
using Rg.Plugins.Popup.Services;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace SSLmobile_cp_v2
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class loadingScreen : PopupPage
    {
		public loadingScreen (bool connectivity)
		{
			InitializeComponent ();
            ActivityIndicator.IsRunning = true;
            checkconnectivity();
        }

        protected override bool OnBackButtonPressed()
        {
            return true;
        }

        void checkconnectivity()
        {
            Device.StartTimer(TimeSpan.FromSeconds(1), () =>
            {
                var isConnected = CrossConnectivity.Current.IsConnected;
                if (isConnected == true)
                {
                    ActivityIndicator.IsRunning = false;
                    PopupNavigation.PopAsync(true);
                    MessagingCenter.Send<App>((App)Application.Current, "refresh");
                    return false;
                }
                else
                {
                    ActivityIndicator.IsRunning = true;
                    return true;
                }
            });
        }
    }
}