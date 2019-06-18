package md56d6c950b757cc8680a6443e6fc71416c;


public class Mainconnectivity
	extends md5b60ffeb829f638581ab2bb9b1a7f4f3f.FormsAppCompatActivity
	implements
		mono.android.IGCUserPeer
{
/** @hide */
	public static final String __md_methods;
	static {
		__md_methods = 
			"n_onCreate:(Landroid/os/Bundle;)V:GetOnCreate_Landroid_os_Bundle_Handler\n" +
			"";
		mono.android.Runtime.register ("SSLmobile_cp_v2.Droid.Mainconnectivity, SSLmobile_cp_v2.Android, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", Mainconnectivity.class, __md_methods);
	}


	public Mainconnectivity ()
	{
		super ();
		if (getClass () == Mainconnectivity.class)
			mono.android.TypeManager.Activate ("SSLmobile_cp_v2.Droid.Mainconnectivity, SSLmobile_cp_v2.Android, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null", "", this, new java.lang.Object[] {  });
	}


	public void onCreate (android.os.Bundle p0)
	{
		n_onCreate (p0);
	}

	private native void n_onCreate (android.os.Bundle p0);

	private java.util.ArrayList refList;
	public void monodroidAddReference (java.lang.Object obj)
	{
		if (refList == null)
			refList = new java.util.ArrayList ();
		refList.add (obj);
	}

	public void monodroidClearReferences ()
	{
		if (refList != null)
			refList.clear ();
	}
}
