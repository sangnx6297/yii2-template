var phoneOptions = {
    loadAlternateLang: true
}

// Occurs After the Language Packs load, at the start of the InitUi() function
var web_hook_on_before_init = function(){
    // console.warn("web_hook_on_before_init");
}
// Occurs at the end of the InitUi() function, before the User Agent is created.
// In order to follow events after the User Agent is created, use the register
// and transport events below.
var web_hook_on_init = function(){
    // console.warn("web_hook_on_init");
}

// Connection and Calling Events
var web_hook_on_transportError = function(t, ua){
    // console.warn("web_hook_on_transportError",t, ua);
}
var web_hook_on_register = function(ua){
    // console.warn("web_hook_on_register", ua);
}
var web_hook_on_registrationFailed = function(e){
    // console.warn("web_hook_on_registrationFailed", e);
}
var web_hook_on_unregistered = function(){
    // console.warn("web_hook_on_unregistered");
}
var web_hook_on_invite = function(session){
    // console.warn("web_hook_on_invite", session);
}
var web_hook_on_message = function(message){
    // console.warn("web_hook_on_message", message);
}
var web_hook_on_modify = function(action, session){
    // console.warn("web_hook_on_modify", action, session);
}
var web_hook_on_dtmf = function(item, session){
    // console.warn("web_hook_on_dtmf", item, session);
}
var web_hook_on_terminate = function(session){
    // console.warn("web_hook_on_terminate", session);
}
var web_hook_on_notify = function(ContentType, buddyObj, notify){
    // console.warn("web_hook_on_notify", ContentType, buddyObj, notify);
}
var web_hook_on_self_notify = function(ContentType, notify){
    // console.warn("web_hook_on_self_notify", ContentType, notify);
}

// UI events
var web_hook_dial_out = function(event){
    // console.warn("web_hook_dial_out", event);
}
var web_hook_on_add_buddy = function(event){
    // console.warn("web_hook_on_add_buddy", event);
}
var web_hook_on_edit_buddy = function(buddyJson){
    // console.warn("web_hook_on_edit_buddy", buddyJson);
}
var web_hook_on_config_menu = function(event){
    // console.warn("web_hook_on_config_menu", event);
}
var web_hook_on_messages_waiting = function(newMsg, oldMsg, ugentNew, ugentOld){
    // console.warn("web_hook_on_messages_waiting", newMsg, oldMsg, ugentNew, ugentOld);
}
var web_hook_on_missed_notify = function(missed){
    // console.warn("web_hook_on_missed_notify", missed);
}
var web_hook_on_expand_video_area = function(lineNum){
    // console.warn("web_hook_on_expand_video_area", lineNum);
}
var web_hook_on_restore_video_area = function(lineNum){
    // console.warn("web_hook_on_restore_video_area", lineNum);
}
var web_hook_on_message_action = function(buddy, obj){
    // console.warn("web_hook_on_message_action", buddy, obj);
}
var web_hook_disable_dnd = function(){
    // console.warn("web_hook_disable_dnd");
}
var web_hook_enable_dnd = function(){
    // console.warn("web_hook_enable_dnd");
}
var web_hook_on_edit_media = function(lineNum, obj){
    // console.warn("web_hook_on_edit_media", lineNum, obj);
}
var web_hook_sort_and_filter = function(event){
    // console.warn("web_hook_sort_and_filter", event);
}