using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Runtime.CompilerServices;
using System.Text;

namespace SSLmobile_cp_v2.Model
{
    class Time : INotifyPropertyChanged
    {
        //public int days { get; set; }
        //public int hrs { get; set; }
        //public int mins { get; set; }
        //public int secs { get; set; }
        int Day;

        public int day
        {
            get
            {
                return Day;
            }

            set
            {
                Day = value;
                OnPropertyChanged("day");
                OnPropertyChanged("timeString");
            }
        }

        int Hr;

        public int hr
        {
            get
            {
                return Hr;
            }

            set
            {
                Hr = value;
                OnPropertyChanged("Hr");
                OnPropertyChanged("timeString");
            }
        }


        int Min;
        public int min
        {
            get
            {
                return Min;
            }

            set
            {
                Min = value;
                OnPropertyChanged("Min");
                OnPropertyChanged("timeString");
            }
        }

        int Sec;
        public int sec
        {
            get
            {
                return Sec;
            }

            set
            {
                Sec = value;
                OnPropertyChanged("Sec");
                OnPropertyChanged("timeString");
            }
        }

        public event PropertyChangedEventHandler PropertyChanged;

        string a = "fuck";

        public string timeString
        {
            get
            {
                return Day + "  |  " + Hr + "  |  " + Min + "  |  " + Sec;
            }
        }



        protected virtual void OnPropertyChanged([CallerMemberName]string propname = null)
        {
            PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(propname));
        }
    }
}
