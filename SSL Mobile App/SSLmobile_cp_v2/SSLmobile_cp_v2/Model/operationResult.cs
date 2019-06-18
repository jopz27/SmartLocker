using System;
using System.Collections.Generic;
using System.Text;

namespace SSLmobile_cp_v2.Model
{
    class operationResult
    {
        public string UID { get; set; }
        public string currentUserIdNumber { get; set; }
        public string name { get; set; }
        public string mobileNumber { get; set; }
        public int lockerId { get; set; }
        public string penalty { get; set; }
        public string userLogoutTime { get; set; }//
        public string userCalculatedPenalty { get; set; }//

        //extra
        public int operationNumber { get; set; }
        public bool reserved { get; set; }
        public int reservedLockerIdNumber { get; set; }
        public string reservationTimeStamp { get; set; }
        public string error { get; set; }

        public string reservationCancelation { get; set; }
        public string passCode { get; set; }
    }
}
