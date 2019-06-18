using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Text;

namespace SSLmobile_cp_v2.Model
{
    class userDetails : INotifyPropertyChanged
    {
        private string mobileNumber;

        public string mobile_number
        {
            get { return mobileNumber; }
            set
            {
                mobileNumber = value;
                OnPropertyChanged("mobile_number");
            }
        }

        public event PropertyChangedEventHandler PropertyChanged;
        
        private void OnPropertyChanged(string propertyName)
        {
            if (PropertyChanged != null)
                PropertyChanged(this, new PropertyChangedEventArgs(propertyName));
        }
    }
}
