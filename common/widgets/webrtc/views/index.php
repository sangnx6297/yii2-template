<?php
?>

<!-- Loading Animation -->
<div class=loading>
    <span class="fa fa-circle-o-notch fa-spin"></span>
</div>


<div id="miniphoneContent" style="margin-left: 0px; height: 20%;">
    <table id="miniphone-ui" class="miniStreamSelected" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <td class="miniStreamSection highlightSection" style="height: 20px;">

                <!--                <div class="contact" style="cursor: unset; float: left;">-->
                <!--                    <div id="line-ui-4-LineIcon" class="lineIcon">1</div>-->
                <!--                    <div id="line-ui-4-DisplayLineNo" class="contactNameText"><i class="fa fa-phone"></i> Line 1</div>-->
                <!--                    <div class="presenceText" style="max-width:150px">0329178017</div>-->
                <!--                </div>-->
                <div class="contact" id="UserProfile" style="cursor: default; margin-bottom:5px; float: left; height: 48px">
                    <div id="UserProfilePic" class="buddyIcon" style="background-image: url('/material/avatars/default.0.webp');"></div>
                    <span class="settingsMenu">
                        <button class="roundButtons" id="SettingsMenu" title="Configure Extension">
                            <i class="fa fa-cogs"></i>
                        </button>
                    </span>
                    <div class="contactNameText" style="margin-right: 0px;">
                        <span id="dereglink" class="dotOnline" style="display:none"></span>
                        <span id="WebRtcFailed" class="dotFailed" style=""></span>
                        <span id="reglink" class="dotOffline"></span>
                        <span id="UserCallID"></span>
                    </div>

                    <div class="presenceText">
                        <span id="regStatus">Connecting to Web Socket...</span>
                        <span id="dndStatus"></span>
                    </div>
                </div>


                <div style="float:right; line-height: 46px;">
                    <button class="dialButtons miniDialButtonsDial" id="dialAudio" title="Audio Call"
                            onclick="DialByLine('audio')"><i class="fa fa-phone"></i></button>
                </div>

                <div id="miniphone-dialpad" class="cleanScroller"
                     style=" float:right; height: 50px; width: 20%; text-align: right">
                    <input id="dialText" class="dialTextInput"
                           oninput="handleDialInput(this, event)"
                           onkeydown="dialOnkeydown(event, this)"
                           style="width:170px; height:32px" value="0329178017">
                    <button id="dialDeleteKey" class="roundButtons" onclick="KeyPress('del')" style="display: none;">⌫
                    </button>
                </div>

                <div style="clear:both; height:0px"></div>
                <div id="miniphone-timer" class="CallTimer">00:00</div>
                <div id="miniphone-msg" class="callStatus" style="">Session Progress...</div>
                <div style="display:none;">
                    <audio id="miniphone-remoteAudio"></audio>
                </div>
                <i class="fas fa-sign-out-alt"></i>
            </td>
        </tr>
        </tbody>
    </table>

</div>


<div id="callingContent" class="rightContent" style="margin-left: 0px; height: 15%;">

</div>

<!-- The Phone -->
<!--<div id=Phone></div>-->
<!--<div style="text-align:center; margin-top:15px">-->
<!---->
<!--    <input id="dialText" class="dialTextInput"-->
<!--                                                       oninput="handleDialInput(this, event)"-->
<!--                                                       onkeydown="dialOnkeydown(event, this)"-->
<!--                                                       style="width:170px; height:32px" value="0329178017">-->
<!--    <button id="dialDeleteKey" class="roundButtons" onclick="KeyPress('del')" style="display: none;">⌫</button>-->
<!---->
<!--</div>-->
<!--<div style="text-align: center; margin-bottom:15px">-->
<!--    <button class="dialButtons dialButtonsDial" id="dialAudio" title="Audio Call"-->
<!--            onclick="DialByLine('audio')"><i class="fa fa-phone"></i></button>-->
<!--</div>-->

<!--<div style="text-align: center; margin-bottom:15px">-->
<!--    <button class="dialButtons dialButtonsDial" id="register" title="Audio Call"-->
<!--            onclick="CreateUserAgent()"><i class="fa fa-user"></i></button>-->
<!--    <button class="dialButtons dialButtonsDial" id="unregister" style="margin-left:20px;"-->
<!--            title="Video Call" onclick="Unregister(false)"><i class="fa fa-sign-out"></i>-->
<!--    </button>-->
<!--</div>-->
<audio id="line-default-remoteAudio"></audio>

<br>
