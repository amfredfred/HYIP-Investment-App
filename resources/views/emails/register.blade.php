@if($type == 'user')
<center>
    <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tbody><tr>
                <td align="center" valign="top" id="">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody><tr>
                                <td valign="top" id="">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                        <tbody>
                                            <tr>
                                                <td valign="top" style="padding:9px">
                                                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" style="min-width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" align="center" style="padding-right:9px;padding-left:9px;padding-top:0;padding-bottom:0;text-align:center">
                                                                    <img src="{{asset('logo_message')}}" width="240" height="100" class="CToWUd">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" id=""></td>
                            </tr>
                            <tr>
                                <td valign="top" id="">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                        <tbody>
                                            <tr>
                                                <td valign="top" style="padding-top:9px">

                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" style="padding-top:9px">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%;min-width:100%" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td colspan="2" valign="top" style="padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px">
                                                                                    <br>
                                                                                    <h2>Welcome  {{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}!</h2>
                                                                                    <p>Thanks for registering with us - We're really excited for you to join our community. You're just one step away to financial freedom. To verify your account, enter the code below in the text box shown on the last registration page.</p>
                                                                                    <p><strong>Verification Code:</strong> {{$user->verified_code}}.</p>
                                                                                  
                                                                                    <p>     {{$settings['site_name']}}</p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" valign="top" style="padding:9px">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" style="padding-left:9px;padding-right:9px">
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" valign="top" style="padding-top:9px;padding-right:9px;padding-left:9px">
                                                                                    <table align="center" border="0" cellpadding="0" cellspacing="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align="center" valign="top">

                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="top" style="padding-right:10px;padding-bottom:9px">
                                                                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px">
                                                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                                                                                        <tbody>
                                                                                                                                            <tr>

                                                                                                                                                <td align="center" valign="middle" width="24">
                                                                                                                                                    <a href="http://www.twitter.com/" rel="noreferrer" target="_blank">
                                                                                                                                                        <img src="https://cdn-images.mailchimp.com/icons/social-block-v2/color-twitter-48.png" style="display:block" height="24" width="24" class="CToWUd"></a>
                                                                                                                                                </td>


                                                                                                                                            </tr>
                                                                                                                                        </tbody>
                                                                                                                                    </table>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="top" style="padding-right:10px;padding-bottom:9px">
                                                                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px">
                                                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                                                                                        <tbody>
                                                                                                                                            <tr>

                                                                                                                                                <td align="center" valign="middle" width="24">
                                                                                                                                                    <a href="http://www.facebook.com" rel="noreferrer" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/color-facebook-48.png" style="display:block" height="24" width="24" class="CToWUd"></a>
                                                                                                                                                </td>


                                                                                                                                            </tr>
                                                                                                                                        </tbody>
                                                                                                                                    </table>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>

                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="top" style="padding-right:0;padding-bottom:9px">
                                                                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px">
                                                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                                                                                        <tbody>
                                                                                                                                            <tr>

                                                                                                                                                <td align="center" valign="middle" width="24">
                                                                                                                                                    <a href="http://contaxt.org" rel="noreferrer" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/color-link-48.png" style="display:block" height="24" width="24" class="CToWUd"></a>
                                                                                                                                                </td>


                                                                                                                                            </tr>
                                                                                                                                        </tbody>
                                                                                                                                    </table>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>

                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" id="" style="background:#222">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">

                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                        <tbody>
                                            <tr>
                                                <td valign="top" style="padding-top:9px">
                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%;min-width:100%" width="100%">
                                                        <tbody>
                                                            <tr>

                                                                <td valign="top" style="padding:0px 18px 9px;color:#ffffff">

                                                                    <em>Copyright © {{$settings['site_name']}}. {{$settings['copy_right']}}.</em><br>
                                                                    <br>
                                                                    <strong>Our mailing address is:</strong><br>
                                                                    <a href="mailto:info@{{$settings['site_email']}}" rel="noreferrer" target="_blank">{{$settings['site_email']}}</a><br>
                                                                    <br>
                                                                    If this E-Mail was sent to you accidentally, we apologize. Please ensure you delete it. Thank you.<br>
                                                                    You can report to <a href="mailto:{{$settings['site_email']}}" rel="noreferrer" target="_blank">{{$settings['site_email']}}</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody></table>
                </td>
            </tr>
        </tbody></table>
</center>
@endif
@if($type == 'admin')
<center>
    <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tbody><tr>
                <td align="center" valign="top" id="">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody><tr>
                                <td valign="top" id="">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                        <tbody>
                                            <tr>
                                                <td valign="top" style="padding:9px">
                                                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" style="min-width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" align="center" style="padding-right:9px;padding-left:9px;padding-top:0;padding-bottom:0;text-align:center">
                                                                    <img src="{{asset($settings['logo']) }}" width="240" height="100" class="CToWUd">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" id=""></td>
                            </tr>
                            <tr>
                                <td valign="top" id="">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                        <tbody>
                                            <tr>
                                                <td valign="top" style="padding-top:9px">

                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" style="padding-top:9px">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%;min-width:100%" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td colspan="2" valign="top" style="padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px">
                                                                                    <br>
                                                                                    <h2>Hello <span style="color:#007bff">Administrator,</span> </h2>
                                                                                    <p>  {{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}} with email address {{$user->email}} just registered an account.</p>

                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" valign="top" style="padding:9px">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" style="padding-left:9px;padding-right:9px">
                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" valign="top" style="padding-top:9px;padding-right:9px;padding-left:9px">
                                                                                    <table align="center" border="0" cellpadding="0" cellspacing="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align="center" valign="top">

                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="top" style="padding-right:10px;padding-bottom:9px">
                                                                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px">
                                                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                                                                                        <tbody>
                                                                                                                                            <tr>

                                                                                                                                                <td align="center" valign="middle" width="24">
                                                                                                                                                    <a href="http://www.twitter.com/" rel="noreferrer" target="_blank">
                                                                                                                                                        <img src="https://cdn-images.mailchimp.com/icons/social-block-v2/color-twitter-48.png" style="display:block" height="24" width="24" class="CToWUd"></a>
                                                                                                                                                </td>


                                                                                                                                            </tr>
                                                                                                                                        </tbody>
                                                                                                                                    </table>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="top" style="padding-right:10px;padding-bottom:9px">
                                                                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px">
                                                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                                                                                        <tbody>
                                                                                                                                            <tr>

                                                                                                                                                <td align="center" valign="middle" width="24">
                                                                                                                                                    <a href="http://www.facebook.com" rel="noreferrer" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/color-facebook-48.png" style="display:block" height="24" width="24" class="CToWUd"></a>
                                                                                                                                                </td>


                                                                                                                                            </tr>
                                                                                                                                        </tbody>
                                                                                                                                    </table>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>

                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="top" style="padding-right:0;padding-bottom:9px">
                                                                                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td align="left" valign="middle" style="padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:9px">
                                                                                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                                                                                        <tbody>
                                                                                                                                            <tr>

                                                                                                                                                <td align="center" valign="middle" width="24">
                                                                                                                                                    <a href="http://contaxt.org" rel="noreferrer" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/color-link-48.png" style="display:block" height="24" width="24" class="CToWUd"></a>
                                                                                                                                                </td>


                                                                                                                                            </tr>
                                                                                                                                        </tbody>
                                                                                                                                    </table>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>

                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" id="" style="color:#222">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">

                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%">
                                        <tbody>
                                            <tr>
                                                <td valign="top" style="padding-top:9px">
                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%;min-width:100%" width="100%">
                                                        <tbody>
                                                            <tr>

                                                                <td valign="top" style="padding:0px 18px 9px;color:#ffffff">

                                                                    <em>Copyright © {{$settings['site_name']}}. {{$settings['copy_right']}}.</em><br>
                                                                    <br>
                                                                    <strong>Our mailing address is:</strong><br>
                                                                    <a href="mailto:info@{{$settings['site_email']}}" rel="noreferrer" target="_blank">{{$settings['site_email']}}</a><br>
                                                                    <br>
                                                                    If this E-Mail was sent to you accidentally, we apologize. Please ensure you delete it. Thank you.<br>
                                                                    You can report to <a href="mailto:{{$settings['site_email']}}" rel="noreferrer" target="_blank">{{$settings['site_email']}}</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody></table>
                </td>
            </tr>
        </tbody></table>
</center>



@endif