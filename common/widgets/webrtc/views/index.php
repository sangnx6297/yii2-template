<?php
/**
 * @var $bowerAssetUrl
 */
?>

<!-- Loading Animation -->



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
<div id="mini-phone-toolbar" class="mini-phone-toolbar mini-phone-toolbar_position_bottom"
     data-height="100" style="display: block;">
    <div class="mini-phone-toolbar__resize-handle"></div>
    <div class="mini-phone-toolbar__bar">

        <div class="mini-phone-toolbar__block mini-phone-toolbar__title mini-phone-toolbar_title__collapsed"
             style="float: right; width: 5%">
            <div class="mini-phone-toolbar__icon">
<!--                <i class="fa fa-phone" width="30" height="30" style="font-size: 36px;color: green;"></i>-->
                <img width="30" height="30" alt="Yii" src="<?php echo $bowerAssetUrl ?>/icons/logo.ico">
            </div>
        </div>

        <div class="mini-phone-toolbar__block" style="width: 95%;float: right;">
            <div id="miniphoneContent" style="margin-left: 0px; height: 20%;">
<!--                <div class=loading>-->
<!--                    <span class="fa fa-circle-o-notch fa-spin"></span>-->
<!--                </div>-->

                <table id="miniphone-ui" class="miniStreamSelected" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td class="miniStreamSection highlightSection" style="height: 20px;">

                            <!--                <div class="contact" style="cursor: unset; float: left;">-->
                            <!--                    <div id="line-ui-4-LineIcon" class="lineIcon">1</div>-->
                            <!--                    <div id="line-ui-4-DisplayLineNo" class="contactNameText"><i class="fa fa-phone"></i> Line 1</div>-->
                            <!--                    <div class="presenceText" style="max-width:150px">0329178017</div>-->
                            <!--                </div>-->
                            <div class="contact" id="UserProfile">
<!--                                <div id="UserProfilePic" class="buddyIcon" style="background-image: url('<?php //echo $bowerAssetUrl ?>/avatars/default.0.webp');"></div>-->
<!--                                <span class="settingsMenu">-->
<!--                                    <button class="roundButtons" id="SettingsMenu" title="Configure Extension">-->
<!--                                        <i class="fa fa-cogs"></i>-->
<!--                                    </button>-->
<!--                                </span>-->
                                <div class="contactNameText" style="margin-left: 0px;">

                                    <span id="dereglink" class="dotOnline" style="display:none"></span>
                                    <span id="WebRtcFailed" class="dotFailed" style=""></span>
                                    <span id="reglink" class="dotOffline"></span>
                                    <span id="UserCallID"></span>
                                </div>

                                <div class="presenceText" style="margin-left: -10px;">
                                    <button class="roundButtons" id="SettingsMenu" title="Configure Extension">
                                        <i class="fa fa-cogs"></i>
                                    </button>
                                    <span id="regStatus">Connecting to Web Socket...</span>
                                    <span id="dndStatus"></span>
                                </div>
                            </div>


                            <div id="miniphone-dialpad" class="cleanScroller" >
                                <input id="dialText" class="dialTextInput"
                                       oninput="handleDialInput(this, event)"
                                       onkeydown="dialOnkeydown(event, this)"
                                       style="width:170px; height:32px" value="">
                                <button id="dialDeleteKey" class="roundButtons" onclick="KeyPress('del')"
                                        style="display: none;">⌫
                                </button>

                                <button class="dialButtons miniDialButtonsDial" id="dialAudio" title="Audio Call"
                                        onclick="DialByLine('audio')"><i class="fa fa-phone"></i></button>
                            </div>

                            <div style="clear:both; height:0px"></div>
                            <div id="miniphone-timer" class="CallTimer">00:00</div>
                            <div id="miniphone-msg" class="callStatus" style="">Online</div>
                            <div style="display:none;">
                                <audio id="miniphone-remoteAudio"></audio>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <div id="callingContent" class="rightContent" style="margin-left: 0px; height: 15%;">

            </div>
            <audio id="line-default-remoteAudio"></audio>
        </div>
        <!---->
        <!--        <div class="mini-phone-toolbar__block">-->
        <!--            <a href="/debug/default/view?panel=profiling&amp;tag=64326e996c893" title="Total request processing time was 2,541 ms">Time <span class="mini-phone-toolbar__label mini-phone-toolbar__label_info">2,541 ms</span></a>-->
        <!--            <a href="/debug/default/view?panel=profiling&amp;tag=64326e996c893" title="Peak memory consumption">Memory <span class="mini-phone-toolbar__label mini-phone-toolbar__label_info">2.240 MB</span></a>-->
        <!--        </div>-->
        <!--        <div class="mini-phone-toolbar__block">-->
        <!--            <a href="/debug/default/view?panel=db&amp;tag=64326e996c893" title="Executed 19 database queries which took 15 ms.">-->
        <!--                DB <span class="mini-phone-toolbar__label mini-phone-toolbar__label_info">19</span> <span class="mini-phone-toolbar__label">15 ms</span>-->
        <!--            </a>-->
        <!--        </div>-->
        <!--        <div class="mini-phone-toolbar__block">-->
        <!--            <a href="/debug/default/view?panel=event&amp;tag=64326e996c893">Events <span class="mini-phone-toolbar__label">40</span></a>-->
        <!--        </div>-->
        <!--        <div class="mini-phone-toolbar__block">-->
        <!--            <a href="/debug/default/view?panel=router&amp;tag=64326e996c893" title="Action: backend\controllers\ManagerController::actionIndex()">Route <span class="mini-phone-toolbar__label">manager/index</span></a>-->
        <!--        </div>-->
        <!--        <div class="mini-phone-toolbar__block">-->
        <!--            <a href="/debug/default/view?panel=request&amp;tag=64326e996c893" title="Status code: 200 OK">Status <span class="mini-phone-toolbar__label mini-phone-toolbar__label_success">200</span></a>-->
        <!--        </div>-->
        <!--        <div class="mini-phone-toolbar__block">-->
        <!--            <a href="/debug/default/view?panel=user&amp;tag=64326e996c893">-->
        <!--                User <span class="mini-phone-toolbar__label mini-phone-toolbar__label_info">2</span>-->
        <!--            </a>-->
        <!--        </div>-->
        <!--        <div class="mini-phone-toolbar__block">-->
        <!--            <a href="/debug/default/view?panel=asset&amp;tag=64326e996c893" title="Number of asset bundles loaded">Asset Bundles <span class="mini-phone-toolbar__label mini-phone-toolbar__label_info">9</span></a>-->
        <!--        </div>-->
        <!---->
        <div class="mini-phone-toolbar__block_last">

        </div>
        <a class="mini-phone-toolbar__external" href="#" target="_blank">
            <span class="mini-phone-toolbar__external-icon"></span>
        </a>

        <span class="mini-phone-toolbar__toggle">
            <span class="mini-phone-toolbar__toggle-icon"></span>
        </span>
    </div>

    <div class="mini-phone-toolbar__view">
        <iframe src="about:blank" frameborder="0" title="Yii2 debug bar"></iframe>
    </div>
</div>

<style>
    @media only screen and (max-width: 2048px) {
        #UserProfile {
            cursor: default; margin-bottom:5px; float: left; height: 60px; width: 40%;
        }

        #miniphone-dialpad {
            float:left;height: 50px;width: 60%;text-align: right
        }

        .dialButtons {
            font-size: 18px;
            border: none;
            border-radius: 100px;
            width: 40px;
            height: 40px;
        }
        .presenceText{
            margin-left: -10px;
        }
        #UserCallID {
            margin-left: 5px;
        }
        .miniStreamSection > .contact > .contactNameText {
            margin-left: 0px;
        }

        .streamSection > .contact {
            cursor: unset;
            float: left ;
            height: 65px;
        }

        .streamSection > .cleanScroller.div {
            float: right;
            height: 50px;
            width: 100%;
        }
    }

    @media only screen and (max-width: 1692px) {
        #UserProfile {
            cursor: default; margin-bottom:5px; float: left; height: 60px; width: 35%;
        }
        #miniphone-dialpad {
            float:left;height: 50px;width: 65%;text-align: right
        }

        .dialButtons {
            font-size: 18px;
            border: none;
            border-radius: 100px;
            width: 40px;
            height: 40px;
        }
        .presenceText{
            margin-left: -10px;
        }
        #UserCallID {
            margin-left: 5px;
        }
        .miniStreamSection > .contact > .contactNameText {

            margin-left: 0px;
        }

        .streamSection > .contact {
            cursor: unset;
            float: left ;
            height: 65px;
        }

        .streamSection > .cleanScroller.div {
            float: right;
            height: 50px;
            width: 100%;
            display: flex;
        }
    }


    @media only screen and (max-width: 1448px) {
        #UserProfile {
            cursor: default; margin-bottom:5px; float: left; height: 60px; width: 100%;
        }
        #miniphone-dialpad {
            float:left;height: 50px;width: 100%;text-align: right
        }

        .dialButtons {
            font-size: 18px;
            border: none;
            border-radius: 100px;
            width: 40px;
            height: 40px;
        }
        .presenceText{
            margin-left: -10px;
            display: flex;
            justify-content: center;
        }
        #UserCallID {
            margin-left: 5px;
        }

        .miniStreamSection > .contact > .contactNameText {
            margin-left: 0px;
            display: flex;
            justify-content: center;
        }

        .streamSection > .contact {
            cursor: unset;
            float: left ;
            height: 65px;
        }

        .streamSection > .cleanScroller {
            clear: both;
            display: flex;
            height: 60px;
        }
    }



</style>