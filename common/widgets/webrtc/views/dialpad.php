<?php
?>
<div class="streamSection">
    <div id="actionArea" style="" class="contactArea cleanScroller">
        <div style="text-align:right">
            <button class="roundButtons" onclick="ShowContacts()"><i class="fa fa-close"></i></button>
        </div>
        <div style="text-align:center; margin-top:15px"><input id="dialText" class="dialTextInput"
                                                               oninput="handleDialInput(this, event)"
                                                               onkeydown="dialOnkeydown(event, this)"
                                                               style="width:170px; height:32px">
            <button id="dialDeleteKey" class="roundButtons" onclick="KeyPress('del')" style="display: none;">⌫</button>
        </div>
        <table cellspacing="10" cellpadding="0" style="margin-left:auto; margin-right: auto">
            <tbody>
            <tr>
                <td>
                    <button class="dialButtons" onclick="KeyPress('1')">
                        <div>1</div>
                        <span>&nbsp;</span></button>
                </td>
                <td>
                    <button class="dialButtons" onclick="KeyPress('2')">
                        <div>2</div>
                        <span>ABC</span></button>
                </td>
                <td>
                    <button class="dialButtons" onclick="KeyPress('3')">
                        <div>3</div>
                        <span>DEF</span></button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="dialButtons" onclick="KeyPress('4')">
                        <div>4</div>
                        <span>GHI</span></button>
                </td>
                <td>
                    <button class="dialButtons" onclick="KeyPress('5')">
                        <div>5</div>
                        <span>JKL</span></button>
                </td>
                <td>
                    <button class="dialButtons" onclick="KeyPress('6')">
                        <div>6</div>
                        <span>MNO</span></button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="dialButtons" onclick="KeyPress('7')">
                        <div>7</div>
                        <span>PQRS</span></button>
                </td>
                <td>
                    <button class="dialButtons" onclick="KeyPress('8')">
                        <div>8</div>
                        <span>TUV</span></button>
                </td>
                <td>
                    <button class="dialButtons" onclick="KeyPress('9')">
                        <div>9</div>
                        <span>WXYZ</span></button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="dialButtons" onclick="KeyPress('*')">*</button>
                </td>
                <td>
                    <button class="dialButtons" onclick="KeyPress('0')">0</button>
                </td>
                <td>
                    <button class="dialButtons" onclick="KeyPress('#')">#</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div style="text-align: center; margin-bottom:15px">
            <button class="dialButtons dialButtonsDial" id="dialAudio" title="Audio Call" onclick="DialByLine('audio')"><i
                    class="fa fa-phone"></i></button>
            <button class="dialButtons dialButtonsDial" id="dialVideo" style="margin-left:20px" title="Video Call"
                    onclick="DialByLine('video')"><i class="fa fa-video-camera"></i></button>
        </div>
    </div>
</div>
