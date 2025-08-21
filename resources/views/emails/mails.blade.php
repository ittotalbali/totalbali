<?php
    $basic_color ='#272B97';
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Pendaftaran Akun</title>
  <style type="text/css">
    body {margin: 0; padding: 0; min-width: 100%!important;}
    img {height: auto;}
    .content {width: 100%; max-width: 600px;}
    .header {padding: 40px 30px 20px 30px;}
    .innerpadding {padding: 30px 30px 30px 30px;}
    .borderbottom {border-bottom: 1px solid #f2eeed;}
    .subhead {font-size: 15px; color: #ffffff; font-family: sans-serif; letter-spacing: 10px;}
    .h1, .h2, .bodycopy {color: #153643; font-family: sans-serif;}
    .h1 {font-size: 33px; line-height: 38px; font-weight: bold;}
    .h2 {padding: 0 0 15px 0; font-size: 24px; line-height: 28px; font-weight: bold;}
    .bodycopy {font-size: 16px; line-height: 22px;}
    .button {text-align: center; font-size: 18px; font-family: sans-serif; font-weight: bold; padding: 0 30px 0 30px;}
    .button a {color: #ffffff; text-decoration: none;}
    .footer {padding: 20px 30px 15px 30px;}
    .footercopy {font-family: sans-serif; font-size: 14px; color: #ffffff;}
    .footercopy a {color: #ffffff; text-decoration: underline;}

    @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
      body[email] .hide {display: none!important;}
      body[email] .buttonwrapper {background-color: transparent!important;}
      body[email] .button {padding: 0px!important;}
      body[email] .button a {background-color: #e05443; padding: 15px 15px 13px!important;}
      body[email] .unsubscribe {display: block; margin-top: 20px; padding: 10px 50px; background: #2f3942; border-radius: 5px; text-decoration: none!important; font-weight: bold;}
    }

  /*@media only screen and (min-device-width: 601px) {
    .content {width: 600px !important;}
    .col425 {width: 425px!important;}
    .col380 {width: 380px!important;}
    }*/
    .btn-danger {
      color: #fff;
      background-color: #272B97;
      border-color: #272B97;
    }
    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .row::after {
      content: "";
      clear: both;
      display: table;
    }

    [class*="col-"] {
      float: left;
      padding: 15px;
    }

    .col-1 {width: 8.33%;}
    .col-2 {width: 16.66%;}
    .col-3 {width: 25%;}
    .col-4 {width: 33.33%;}
    .col-5 {width: 41.66%;}
    .col-6 {width: 50%;}
    .col-7 {width: 58.33%;}
    .col-8 {width: 66.66%;}
    .col-9 {width: 75%;}
    .col-10 {width: 83.33%;}
    .col-11 {width: 91.66%;}
    .col-12 {width: 100%;}

  </style>
</head>

<body email bgcolor="#f6f8f1">
  <table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>
    <!--[if (gte mso 9)|(IE)]>
      <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td>
          <![endif]-->
          <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td bgcolor="#272B97" class="header">
                <table width="70" align="left" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td >
                       <img class="image-footer" src="https://lba-ganesha.sevenpion.com/assets/images/logo-perusahaan-putih.png" style="max-width: 40px" alt="logo-perusahaan">
                    </td>
                  </tr>
                </table>
          <!--[if (gte mso 9)|(IE)]>
            <table width="425" align="left" cellpadding="0" cellspacing="0" border="0">
              <tr>
               <td>
               <![endif]-->
                {{-- <table class="col425" align="right" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 425px;">
                  <tr>
                    <td height="70">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="subhead" style="padding: 0 0 0 3px;">
                            Pendaftaran
                          </td>
                        </tr>
                        <tr>
                          <td class="h1" style="padding: 5px 0 0 0;color:white;">
                            LBA Ganesha
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table> --}}
          <!--[if (gte mso 9)|(IE)]>
                </td>
              </tr>
          </table>
        <![endif]-->
      </td>
    </tr>
    <tr>
      <td class="innerpadding borderbottom">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="h2">
              Hai {{ $user['name'] }} !<br>
              PENDAFTARAN AKUN ANDA BERHASIL
            </td>
          </tr>
          <tr>
            <td class="bodycopy">
              Terima Kasih telah melakukan pendaftaran akun LBA Ganesha, Silahkan klik tombol dibawah untuk mengaktifkan akun LBA Ganesha anda.
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td class="innerpadding borderbottom">
          <!--[if (gte mso 9)|(IE)]>
            <table width="380" align="left" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td>
                <![endif]-->
                <table class="col380" align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 380px;">
                  <tr>
                    <td>

                    </td>
                  </tr>
                  <tr>
                    <td>
                        <a class="btn btn-danger" style="width: 100%;text-decoration: none;font-family: sans-serif;" href="{{ url('register/verify-email', $token) }}" target="_blank">Konfirmasi Email </a>
                    </td>
                  </tr>
                </table>
          <!--[if (gte mso 9)|(IE)]>
                </td>
              </tr>
          </table>
        <![endif]-->
      </td>
    </tr>
    <tr>
      <td class="innerpadding bodycopy">
          Setelah akun Anda diaktifkan anda dapat menggunakan layanan yang ditawarkan.
      </td>
    </tr>
    <tr>
      <td class="innerpadding bodycopy">
        Anda menerima email ini karena Anda baru saja membuat akun LBA Ganesha baru. Jika ini bukan Anda harap abaikan email ini.
      </td>
    </tr>
   <tr>
      <td class="footer" bgcolor="#272B97">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" style="padding: 20px 0 0 0;" colspan="2">
            </td>
          </tr>
          <tr>
            <td colspan="2" class="bodycopy">
              <br>
              <center><span style="color: white">© <?php echo date('Y') ?> LBA Ganesha. All rights reserved</span></center>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
    <!--[if (gte mso 9)|(IE)]>
          </td>
        </tr>
    </table>
  <![endif]-->
</td>
</tr>
</table>
</body>
</html>
