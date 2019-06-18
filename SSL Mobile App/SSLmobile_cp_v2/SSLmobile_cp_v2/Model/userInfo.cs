using System;
using System.Collections.Generic;
using System.Text;

namespace SSLmobile_cp_v2.Model
{
    public class userInfo
    {
        public string UID { get; set; }
        public string idNumber { get; set; }
        public string name { get; set; }
        public string mobileNumber { get; set; }
        public int lockerId { get; set; }
        public string penalty { get; set; }
        public string userError { get; set; }
        public string userLogoutTime { get; set; }
        public string userCalculatedPenalty { get; set; }
    }
}
