  // JavaScript Document
  $( window ).load(function() {
// Run code
$(".sidebar-mini").addClass('sidebar-collapse');
});
$(document).ready(function () {
"use strict";
// select 2 dropdown
$("select.form-control:not(.dont-select-me)").select2({
placeholder: "Select option",
allowClear: true
});
//form validate
$("#validate").validate();
$("#add_category").validate();
$("#customer_name").validate();
$('.productclist').slimScroll({
size: '3px',
height: '345px',
allowPageScroll: true,
railVisible: true
});
$('.product-grid').slimScroll({
size: '3px',
height: '720px',
allowPageScroll: true,
railVisible: true
});
$('.update_search-field').select2({
placeholder: 'Select Product',
minimumInputLength: 1,
ajax: {
url: basicinfo.baseurl+'ordermanage/order/getitemlistdroup',
dataType: 'json',
delay: 250,
//data:{csrf_test_name:basicinfo.csrftokeng},
processResults: function (data) {
return {
results:  $.map(data, function (item) {
return {
text: item.text+'-'+item.variantName,
id: item.id+'-'+item.variantid
}
})
};
},
cache: true
}
});
});
$(document).on('change','#update_product_name', function(){
var tid = $(this).children("option:selected").val();
var idvid=tid.split('-');
var id=idvid[0];
var vid=idvid[1];
var csrf = $('#csrfhashresarvation').val();
var updateid=$("#saleinvoice").val();
var url= basicinfo.baseurl+'ordermanage/order/addtocartupdate_uniqe'+'/'+id+'/'+updateid;
/*check production*/
/*please fixt cart total counting*/
var productionsetting = $('#production_setting').val();
if(productionsetting == 1){

var checkqty = 1;
var checkvalue = checkproduction(id,vid,checkqty);
if(checkvalue == false){
$('#update_product_name').html('');
return false;
}

}
/*end checking*/
$.ajax({
type: "GET",
url: url,
data: {csrf_test_name:csrf},
success: function(data) {


var myurl =basicinfo.baseurl+"ordermanage/order/adonsproductadd"+'/'+id;
$.ajax({
type: "GET",
url: myurl,
data: {csrf_test_name:csrf},
success: function(data) {
$('.addonsinfo').html(data);
$('#edit').modal('show');
var tax=$('#tvat').val();
var discount=$('#tdiscount').val();
var tgtotal=$('#tgtotal').val();
$('#vat').val(tax);
$('#calvat').text(tax);
var sc=$('#sc').val();
$('#service_charge').val(sc);
$('#invoice_discount').val(discount);
$('#caltotal').text(tgtotal);
$('#grandtotal').val(tgtotal);
$('#orggrandTotal').val(tgtotal);
$('#orginattotal').val(tgtotal);
$('#update_product_name').html('');
}
});



}
});

});

function getslcategory_update(carid){
var product_name = $('#update_product_name').val();
var category_id = carid;
var myurl= $('#posurl_update').val();
var csrf = $('#csrfhashresarvation').val();
$.ajax({
type: "post",
async: false,
url: myurl,
data: {product_name: product_name,category_id:category_id,isuptade:1,csrf_test_name:csrf},
success: function(data) {
if (data == '420') {
$("#product_search_update").html('Product not found !');
}else{
$("#product_search_update").html(data);
}
},
error: function() {
alert(lang.req_failed);
}
});
}
//Product search button js
$('body').on('click', '#search_button', function() {
var product_name = $('#update_product_name').val();
var category_id = $('#category_id').val();
var myurl= $('#posurl_update').val();
var csrf = $('#csrfhashresarvation').val();
$.ajax({
type: "post",
async: false,
url: myurl,
data: {product_name: product_name,category_id:category_id,csrf_test_name:csrf},
success: function(data) {
if (data == '420') {
$("#product_search_update").html('Product not found !');
}else{
$("#product_search_update").html(data);
}
},
error: function() {
alert(lang.req_failed);
}
});
});
//Product search button js
$('body').on('click', '.update_select_product', function(e) {
e.preventDefault();
var panel = $(this);
var pid = panel.find('.panel-body input[name=update_select_product_id]').val();
var sizeid = panel.find('.panel-body input[name=update_select_product_size]').val();
var totalvarient = panel.find('.panel-body input[name=select_totalvarient]').val();
var customqty = panel.find('.panel-body input[name=select_iscustomeqty]').val();
var isgroup = panel.find('.panel-body input[name=update_select_product_isgroup]').val();
var catid = panel.find('.panel-body input[name=update_select_product_cat]').val();
var itemname= panel.find('.panel-body input[name=update_select_product_name]').val();
var varientname=panel.find('.panel-body input[name=update_select_varient_name]').val();
var qty=1;
var price=panel.find('.panel-body input[name=update_select_product_price]').val();
var hasaddons=panel.find('.panel-body input[name=update_select_addons]').val();
var existqty=$('#select_qty_'+pid+'_'+sizeid).val();
var csrf = $('#csrfhashresarvation').val();
if(existqty === undefined){
var existqty=0;
}
else{
var existqty=$('#select_qty_'+pid+'_'+sizeid).val();
}
var qty=parseInt(existqty)+parseInt(qty);
var updateid=$("#saleinvoice").val();
if(hasaddons==0 && totalvarient==1 && customqty==0){
var mysound=baseurl+"assets/";
var audio =["beep-08b.mp3"];
new Audio(mysound + audio[0]).play();
var myurl= $('#updatecarturl').val();
var dataString = "pid="+pid+'&itemname='+itemname+'&varientname='+varientname+'&qty='+qty+'&price='+price+'&catid='+catid+'&sizeid='+sizeid+'&isgroup='+isgroup+'&orderid='+updateid+'&totalvarient='+totalvarient+'&customqty='+customqty+'&csrf_test_name='+csrf;
$.ajax({
type: "POST",
url: myurl,
data: dataString,
success: function(data) {
$('#updatefoodlist').html(data);
var total=$('#grtotal').val();
var totalitem=$('#totalitem').val();
$('#item-number').text(totalitem);
$('#getitemp').val(totalitem);
var tax=$('#tvat').val();

var discount=$('#tdiscount').val();
var tgtotal=$('#tgtotal').val();
$('#calvat').text(tax);
$('#invoice_discount').val(discount);
var sc=$('#sc').val();
$('#service_charge').val(sc);
$('#caltotal').text(tgtotal);
$('#grandtotal').val(tgtotal);
$('#orggrandTotal').val(tgtotal);
$('#orginattotal').val(tgtotal);
}
});
}
else{

var geturl=$("#addonexsurl").val();
var myurl =geturl+'/'+pid;
var dataString = "pid="+pid+"&sid="+sizeid+"&id="+catid+"&totalvarient="+totalvarient+"&customqty="+customqty+'&csrf_test_name='+csrf;
$.ajax({
type: "POST",
url: geturl,
data: dataString,
success: function(data) {
$('.addonsinfo').html(data);
$('#edit').modal('show');
var tax=$('#tvat').val();
var discount=$('#tdiscount').val();
var tgtotal=$('#tgtotal').val();
$('#vat').val(tax);
$('#calvat').text(tax);
$('#invoice_discount').val(discount);
$('#caltotal').text(tgtotal);
$('#grandtotal').val(tgtotal);
$('#orggrandTotal').val(tgtotal);
$('#orginattotal').val(tgtotal);
}
});
}
});

//Payment method toggle
$(document).ready(function(){
if(orderinfo.isthirdparty>0){
$("#nonthirdparty_update").hide();
$("#thirdparty_update").show();
$("#delivercom_update").prop('disabled', false);
$("#waiter_update").prop('disabled', true);
$("#tableid_update").prop('disabled', true);
$("#cardarea_update").show();
 } else{
if(orderinfo.cutomertype==4){
$("#nonthirdparty_update").show();
$("#thirdparty_update").hide();
$("#tblsec_update").hide();
$("#delivercom_update").prop('disabled', true);
$("#waiter_update").prop('disabled', false);
$("#tableid_update").prop('disabled', true);
$("#cardarea_update").hide();
}else if(orderinfo.cutomertype==2){
$("#nonthirdparty_update").show();
$("#thirdparty_update").hide();
$("#tblsec_update").hide();
$("#delivercom_update").prop('disabled', true);
$("#waiter_update").prop('disabled', false);
$("#tableid_update").prop('disabled', true);
$("#cardarea_update").hide();
} else{
$("#nonthirdparty_update").show();
$("#tblsec_update").show();
$("#thirdparty_update").hide();
$("#delivercom_update").prop('disabled', true);
$("#waiter_update").prop('disabled', false);
$("#tableid_update").prop('disabled', false);
$("#cardarea_update").hide();
} }

$(".payment_button").click(function(){
$(".payment_method").toggle();
//Select Option
$("select.form-control:not(.dont-select-me)").select2({
placeholder: "Select option",
allowClear: true
});
});

$("#card_typesl").on('change', function(){
var cardtype=$("#card_typesl").val();

$("#card_type").val(cardtype);
if(cardtype==4){
$("#isonline").val(0);
$("#cardarea").hide();
$("#assigncard_terminal").val('');
$("#assignbank").val('');
$("#assignlastdigit").val('');
}
else if(cardtype==1){
$("#isonline").val(0);
$("#cardarea").show();
}
else{
$("#isonline").val(1);
$("#cardarea").hide();
$("#assigncard_terminal").val('');
$("#assignbank").val('');
$("#assignlastdigit").val('');
}

});
$("#ctypeid_update").on('change', function(){
var customertype=$("#ctypeid_update").val();
if(customertype==3){
$("#delivercom_update").prop('disabled', false);
$("#waiter_update").prop('disabled', true);
$("#tableid_update").prop('disabled', true);
$("#nonthirdparty_update").hide();
$("#thirdparty_update").show();
}
else if(customertype==4){
$("#nonthirdparty_update").show();
$("#thirdparty_update").hide();
$("#tblsec_update").hide();
$("#delivercom_update").prop('disabled', true);
$("#waiter_update").prop('disabled', false);
$("#tableid_update").prop('disabled', true);
}
else if(customertype==2){
$("#nonthirdparty_update").show();
$("#tblsec_update").hide();
$("#thirdparty_update").hide();
$("#waiter_update").prop('disabled', false);
$("#tableid_update").prop('disabled', false);
$("#cookingtime_update").prop('disabled', false);
$("#delivercom_update").prop('disabled', true);
}
else{
$("#nonthirdparty_update").show();
$("#tblsec_update").show();
$("#thirdparty_update").hide();
$("#delivercom_update").prop('disabled', true);
$("#waiter_update").prop('disabled', false);
$("#tableid_update").prop('disabled', false);
}
});

});
function printRawHtml(view) {
printJS({
printable: view,
type: 'raw-html',

});
}
function postupdateorder_ajax(){
var form = $('#insert_purchase');
var url = form.attr('action');
var data = form.serialize();
var csrf = $('#csrfhashresarvation').val();

$.ajax({
url:url,
type:'POST',
data:data,
dataType: 'json',

beforeSend:function(xhr){

$('span.error').html('');
},

success:function(result){
swal({
title: result.msg,
text: result.tokenmsg,
type: "success",
showCancelButton: true,
confirmButtonColor: "#28a745",
confirmButtonText: "Yes",
cancelButtonText: "No",
closeOnConfirm: true,
closeOnCancel: true
},
function (isConfirm) {
if (isConfirm) {
$.ajax({
type: "GET",
data: {csrf_test_name:csrf},
url: basicinfo.baseurl+"ordermanage/order/postokengenerateupdate/"+result.orderid+"/1",
success: function(data) {
printRawHtml(data);
}
});
} else {

$.ajax({
type: "GET",
data: {csrf_test_name:csrf},
url: basicinfo.baseurl+"ordermanage/order/tokenupdate/"+result.orderid,
success: function(data) {
console.log("done");
window.location.href=basicinfo.baseurl+"ordermanage/order/orderlist";
}
});
}
});
setTimeout(function () {
toastr.options = {
closeButton: true,
progressBar: true,
showMethod: 'slideDown',
timeOut: 4000,

};
toastr.success(result.msg, 'Success');

}, 300);
console.log(result)
},error:function(a){

}
});
}
function positemupdate(itemid,existqty,orderid,varientid,isgroup,auid,status){
var csrf = $('#csrfhashresarvation').val();
var dataString = "itemid="+itemid+"&existqty="+existqty+"&orderid="+orderid+"&varientid="+varientid+"&auid="+auid+"&status="+status+"&isgroup="+isgroup+'&csrf_test_name='+csrf;
var myurl=basicinfo.baseurl+"ordermanage/order/itemqtyupdate";
$.ajax({
type: "POST",
url: myurl,
data: dataString,
success: function(data) {
$('#updatefoodlist').html(data);
var total=$('#grtotal').val();
var totalitem=$('#totalitem').val();
$('#item-number').text(totalitem);
$('#getitemp').val(totalitem);
var tax=$('#tvat').val();

var discount=$('#tdiscount').val();
var tgtotal=$('#tgtotal').val();
$('#calvat').text(tax);
$('#invoice_discount').val(discount);
var sc=$('#sc').val();
$('#service_charge').val(sc);
$('#caltotal').text(tgtotal);
$('#grandtotal').val(tgtotal);
$('#orggrandTotal').val(tgtotal);
$('#orginattotal').val(tgtotal);
}
});
}
function itemnote(rowid,notes,qty,isupdate,isgroup=null){
$("#foodnote").val(notes);
$("#foodqty").val(qty);
$("#foodcartid").val(rowid);
$("#foodgroup").val(isgroup);
if(isupdate==1){
$("#notesmbt").text("Update Note");
$("#notesmbt").attr("onclick","addnotetoupdate()");
}
else{
$("#notesmbt").text("Update Note");
$("#notesmbt").attr("onclick","addnotetoitem()");
}
$('#vieworder').modal('show');
}
function addnotetoupdate(){
var csrf = $('#csrfhashresarvation').val();
var rowid=$("#foodcartid").val();
var note=$("#foodnote").val();
var orderid=$("#foodqty").val();
var group=$("#foodgroup").val();
var geturl=basicinfo.baseurl+'ordermanage/order/addnotetoupdate';
var dataString = "foodnote="+note+'&rowid='+rowid+'&orderid='+orderid+'&group='+group+'&csrf_test_name='+csrf;
$.ajax({
type: "POST",
url: geturl,
data: dataString,
success: function(data) {
setTimeout(function () {
toastr.options = {
closeButton: true,
progressBar: true,
showMethod: 'slideDown',
timeOut: 4000
};
toastr.success("Note Added Successfully", 'Success');
$('#updatefoodlist').html(data);
$('#vieworder').modal('hide');
}, 100);

}
});
}