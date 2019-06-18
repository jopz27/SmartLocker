using SSLmobile_cp_v2.Model;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.ComponentModel;
using System.Linq;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using Refit;
using SSLmobile_cp_v2.Interface;

namespace SSLmobile_cp_v2
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class ListViewTransaction : ContentPage
    {
        private List<userInfo> userInfos = new List<userInfo>();
        private List<Transaction> transactions = new List<Transaction>();
        //public ObservableCollection<string> Items { get; set; }

        public ListViewTransaction(List<userInfo> passedUserInfos)
        {
            userInfos = passedUserInfos;
            InitializeComponent();
        }

        protected async override void OnAppearing()
        {
            base.OnAppearing();
            await getUpdate();
            
            Transactions.ItemsSource = transactions;
        }

        async Task getUpdate()
        {
            
            Button alertButton = new Button();
            try
            {
                var apiResponse = RestService.For<SslApi>(Constants.baseURL);

                //request for transactions list of current user user/api/id/0/0
                transactions = await apiResponse.GetTransactions(userInfos[0].idNumber, 0, 0);
            }
            catch(Exception ex)
            {
                await DisplayAlert("error retrieving locker status! /n" + ex, String.Format("{0}", alertButton.Text), "OK");
            }
        }

        async void Handle_ItemTapped(object sender, ItemTappedEventArgs e)
        {
            if (e.Item == null)
                return;

            await DisplayAlert("Item Tapped", "An item was tapped.", "OK");

            //Deselect Item
            ((ListView)sender).SelectedItem = null;
        }
    }
}
