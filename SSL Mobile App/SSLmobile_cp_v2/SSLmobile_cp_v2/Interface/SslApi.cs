using System.Collections.Generic;
using System.Threading.Tasks;
using Refit;

using SSLmobile_cp_v2.Model;
namespace SSLmobile_cp_v2.Interface
{
    [Headers("Content-Type: application/json")]
    interface SslApi
    {
        //get user detail
        //requestMethod(relative URL)
        [Get("/api/user/{idNumberEntry}/{passwordEntry}")]
        //Task<responseType>
        Task<List<userInfo>> Getvalidation(string idNumberEntry, string passwordEntry);

        //get locker status
        //calls public List<locker> GetStatus(int id)
        [Get("/api/user/{id}")]
        Task<List<lockerStatusResult>> GetLockerStatuses(int id);

        //transactions
        [Get("/api/user/{idNumber}/{op}/{id}")]
        Task<List<Transaction>> GetTransactions(string idNumber, int op, int id);

        //operations
        //1 = penalty/reservation check, 2 = reserve locker, 3 = change mobile number
        //pass URL e.g. api/user/2009024799/2/1/+639290185142
        [Get("/api/user/{idNumber}/{operation}/{lockerId}/{mobileNumber}")]
        Task<List<operationResult>> OperationPasser(string idNumber, int operation, int lockerId, string mobileNumber);
    }
}
