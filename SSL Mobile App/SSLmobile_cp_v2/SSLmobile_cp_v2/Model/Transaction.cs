using System;
using System.Collections.Generic;
using System.Text;

namespace SSLmobile_cp_v2.Model
{
    class Transaction
    {
        public int transationId { get; set; }
        public string idNumber { get; set; }
        public string name { get; set; }
        public int lockerId { get; set; }
        public string reservedDate { get; set; } //date to string
        public string reservedTime { get; set; } //time to string
        public string dateIn { get; set; } //date to string
        public string timeIn { get; set; } //time to string
        public string dateOut { get; set; } //date to string
        public string timeOut { get; set; } //time to string
        public string status { get; set; }
        public string way { get; set; }

        public string error { get; set; }
    }
}
