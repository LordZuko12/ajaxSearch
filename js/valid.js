function valid(){
   if(this.form1.aiubid.value=="")
   {
       this.form1.aiubid.style.border="2px solid red";
       this.form1.aiubid.placeholder="Please input a valid ID";
       document.getElementById("iderr").innerHTML="";
       return false;
   }
   if (this.form1.aiubid.value!=null)
   {
        var gval=this.form1.aiubid.value;
        var sidregex=/^[0-9]{2}-[0-9]{5}-[1-3]/;
        var fidregex=/^[0-9]{3,4}-[0-9]{3,4}-[1-3]/;

        if(sidregex.test(gval)==false)
        {
          if(fidregex.test(gval)==false)
            {
              this.form1.aiubid.style.border="2px solid red";
              document.getElementById("iderr").innerHTML="Please input the id in Teacher or Student valid ID format";
              return false;
            }
        }
    }
   if(this.form1.fullname.value=="")
   {
      this.form1.fullname.style.border="2px solid red";
      this.form1.fullname.placeholder="Please input a valid Name";
      this.form1.aiubid.style.border="2px solid green";
      document.getElementById("iderr").innerHTML="";
      return false;
   }
   if(this.form1.email.value=="")
   {
      this.form1.email.style.border="2px solid red";
      this.form1.email.placeholder="Please input a valid email address";
      this.form1.fullname.style.border="2px solid green";
      document.getElementById("iderr").innerHTML="";
      return false;
   }
   if(this.form1.phone.value=="")
   {
      this.form1.phone.style.border="2px solid red";
      this.form1.phone.placeholder="Please input a valid phone number";
      this.form1.email.style.border="2px solid green";
      document.getElementById("iderr").innerHTML="";
      return false;
   }
   if(this.form1.password.value=="")
   {
      this.form1.password.style.border="2px solid red";
      this.form1.password.placeholder="Please input a valid password";
      this.form1.phone.style.border="2px solid green";
      document.getElementById("iderr").innerHTML="";
      return false;
   }

   return true;

}