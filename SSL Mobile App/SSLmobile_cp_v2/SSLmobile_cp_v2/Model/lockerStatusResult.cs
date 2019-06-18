using System;
using System.Collections.Generic;
using System.Text;

namespace SSLmobile_cp_v2.Model
{
    class lockerStatusResult
    {
        public int lockerId { get; set; }
        public string lockerStatus { get; set; }
        public string lockerIdNumber { get; set; }
    }
    class availableLocker
    {
        public int lockerId { get; set; }
    }
}
