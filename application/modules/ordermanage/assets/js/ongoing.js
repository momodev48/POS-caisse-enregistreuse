// JavaScript Document
$(document).ready(function(){
	"use strict";
                $('.search-table-field').select2({
                    placeholder: lang.type_slorder,
                     minimumInputLength: 1,
                  ajax: {
                    url: 'ongoingtable_name',
                    dataType: 'json',
                    delay: 250,
					data:{csrf_test_name:basicinfo.csrftokeng},
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (item) {
                              return {
                                  text: item.text,
                                  id: item.id
                              }
                          })
                      };
                    },
                    cache: true
                  }
                });
              });
			  $(document).ready(function(){
                $('.search-tablesr-field').select2({
                    placeholder: lang.type_table,
                     minimumInputLength: 1,
                  ajax: {
                    url: 'ongoingtablesearch',
                    dataType: 'json',
                    delay: 250,
					data:{csrf_test_name:basicinfo.csrftokeng},
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (item) {
                              return {
                                  text: item.text,
                                  id: item.id
                              }
                          })
                      };
                    },
                    cache: true
                  }
                });
              });