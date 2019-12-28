<script>
        ///////////////////////////////////////////////
        {
			$j("input").attr("readonly", true);
			$j("textarea").attr("readonly", true);
            $j("select").attr("disabled", true);
            setTimeout(function(){ 
                $j(".nicEdit-main").attr("contenteditable", "false");
                $j('input[type="radio"]').attr("disabled", true);
            }, 1000);
			
			$j('[class="control-label text-muted"]').hide();
			$j('#ot_SharedLink1_remove').hide();
			$j('#ot_SharedLink2_remove').hide();
			$j('#addLink').hide();
			$j('#addDocument').hide();
            $j('#addCompFolder').hide();
            $j('#addPhoto').hide();
            
            if ($j('#ot_Ref01').val().length == 0) {
                       $j('#ot_Ref01').parent().hide();
            }
            if ($j('#ot_Ref02').val().length == 0) {
                       $j('#ot_Ref02').parent().hide();
            }
            if ($j('#ot_Ref03').val().length == 0) {
                       $j('#ot_Ref03').parent().hide();
            }
            if ($j('#ot_Ref04').val().length == 0) {
                       $j('#ot_Ref04').parent().hide();
            }
            if ($j('#ot_Ref05').val().length == 0) {
                       $j('#ot_Ref05').parent().hide();
            }
            if ($j('#ot_Ref06').val().length == 0) {
                       $j('#ot_Ref06').parent().hide();
            }
            if ($j('#ot_Photo01').val().length == 0) {
                       $j('#ot_Photo01').parent().hide();
            }
            if ($j('#ot_Photo02').val().length == 0) {
                       $j('#ot_Photo02').parent().hide();
            }
            if ($j('#ot_Photo03').val().length == 0) {
                       $j('#ot_Photo03').parent().hide();
            }

			$j("#startEdit").click(function(){
				$j("input").attr("readonly", false);
				$j("textarea").attr("readonly", false);
                $j("select").attr("disabled", false);
                $j('[class="control-label text-muted"]').show();
                $j('input[type="radio"]').attr("disabled", false);
				$j(".nicEdit-main").attr("contenteditable", "true");

				if (!$j("#ot_SharedLink1").is(":visible")) {
					$j("#ot_SharedLink1").show();
					$j('#ot_SharedLink1_remove').show();
				}

				if (!$j("#ot_Ref01").is(":visible")) {
					$j("#ot_Ref01").parent().parent().show();
                }
                if (!$j("#ot_Ref04").is(":visible")) {
					$j("#ot_Ref04").parent().parent().show();
                }
                if (!$j("#ot_Photo01").is(":visible")) {
					$j("#ot_Photo01").parent().parent().show();
                }
                
                $j('#addLink').show();
                $j('#addDocument').show();
                $j('#addCompFolder').show();
                $j('#addPhoto').show();

				$j(this).hide();
				$j("#exitEdit").show();
			});
			
			$j("#exitEdit").click(function(){
				$j("input").attr("readonly", true);
				$j("textarea").attr("readonly", true);
                $j("select").attr("disabled", true);
                $j('input[type="radio"]').attr("disabled", true);
				$j(".nicEdit-main").attr("contenteditable", "false");
				$j('#ot_SharedLink1_remove').hide();
                $j('#ot_SharedLink2_remove').hide();
                $j('#addLink').hide();
                $j('#addDocument').hide();
                $j('#addCompFolder').hide();
                $j('#addPhoto').hide();
				$j(this).hide();
				$j("#startEdit").show();
            });
        }
            
            ///////////////////////////////////////////////
		{
			var _x = $j('#totalLinkAttached').html();
			if (!_x) {
				_x = 0;
			}

			if ($j('#ot_SharedLink1').val().length > 0) {
				_x++;
			}

			if ($j('#ot_SharedLink2').val().length > 0) {
				_x++;
			} else {
				$j('#ot_SharedLink2').hide();
				$j('#ot_SharedLink2_remove').hide();
			}

			$j('#totalLinkAttached').html(_x);

			$j('#ot_SharedLink1').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_SharedLink1').val().length > 0) {
					x++;
				}
				if ($j('#ot_SharedLink2').val().length > 0) {
					x++;
				}
				$j('#totalLinkAttached').html(x);
			});
			$j('#ot_SharedLink2').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_SharedLink1').val().length > 0) {
					x++;
				}
				if ($j('#ot_SharedLink2').val().length > 0) {
					x++;
				}
				$j('#totalLinkAttached').html(x);
			});
			$j('#ot_SharedLink1_remove').click(function () {
				var x = $j('#totalLinkAttached').html();
				if (!x) {
					x = 0;
				}
				if ($j('#ot_SharedLink1').val().length > 0 && $j('#ot_SharedLink2').val().length > 0) {
					$j('#ot_SharedLink1').val('');
					$j("#ot_SharedLink1").hide();
					$j('#ot_SharedLink1_remove').hide();
					$j("#addLink").show()
					x--;
				} else if ($j('#ot_SharedLink1').val().length > 0 && $j('#ot_SharedLink2').val().length == 0) {
					$j('#ot_SharedLink1').val('');
					x--;
				} else if ($j('#ot_SharedLink1').val().length == 0 && $j('#ot_SharedLink2').val().length == 0) {
					$j("#ot_SharedLink1").hide();
					$j('#ot_SharedLink1_remove').hide();
					$j("#addLink").show();
				}
				$j('#totalLinkAttached').html(x);
			});
			$j('#ot_SharedLink2_remove').click(function () {
				var x = $j('#totalLinkAttached').html();
				if (!x) {
					x = 0;
				}
				if ($j('#ot_SharedLink1').val().length > 0 && $j('#ot_SharedLink2').val().length > 0) {
					$j('#ot_SharedLink2').val('');
					$j("#ot_SharedLink2").hide();
					$j('#ot_SharedLink2_remove').hide();
					$j("#addLink").show();
					x--;
				} else if ($j('#ot_SharedLink1').val().length == 0 && $j('#ot_SharedLink2').val().length > 0) {
					$j('#ot_SharedLink2').val('');
					x--;
				} else if ($j('#ot_SharedLink1').val().length == 0 && $j('#ot_SharedLink2').val().length == 0) {
					$j("#ot_SharedLink2").hide();
					$j('#ot_SharedLink2_remove').hide();
					$j("#addLink").show();
				}
				$j('#totalLinkAttached').html(x);
			});
			$j("#addLink").click(function () {

				if (!$j("#ot_SharedLink1").is(":visible")) {
					$j("#ot_SharedLink1").show();
					$j('#ot_SharedLink1_remove').show();
				} else if (!$j("#ot_SharedLink2").is(":visible")) {
					$j("#ot_SharedLink2").show();
					$j('#ot_SharedLink2_remove').show();
				}

				if ($j("#ot_SharedLink1").is(":visible") && $j("#ot_SharedLink2").is(":visible")) {
					$j("#addLink").hide();
				}
			});
		}
		///////////////////////////////////////////////
		{
			var _x = $j('#totalDocumentAttached').html();
			if (!_x) {
				_x = 0;
			}
			if ($j('#ot_Ref01').val().length > 0) {
				_x++;
			}
			if ($j('#ot_Ref02').val().length > 0) {
				_x++;
			} else {
				// $j('#ot_Ref02').hide();
				$j("#ot_Ref02").parent().hide();
			}
			if ($j('#ot_Ref03').val().length > 0) {
				_x++;
			} else {
				// $j('#ot_Ref03').hide();
				$j("#ot_Ref03").parent().hide();
			}
			$j('#totalDocumentAttached').html(_x);

			$j('#ot_Ref01').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_Ref01').val().length > 0) {
					x++;
				}
				if ($j('#ot_Ref02').val().length > 0) {
					x++;
				}
				$j('#totalDocumentAttached').html(x);
			});
			$j('#ot_Ref02').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_Ref01').val().length > 0) {
					x++;
				}
				if ($j('#ot_Ref02').val().length > 0) {
					x++;
				}
				$j('#totalDocumentAttached').html(x);
			});

			$j("#addDocument").click(function () {

				if (!$j("#ot_Ref01").parent().parent().is(":visible")) {
					// $j("#ot_Ref01").show();
					$j("#ot_Ref01").parent().parent().show();
				} else if (!$j("#ot_Ref02").parent().parent().is(":visible")) {
					// $j("#ot_Ref02").show();
					$j("#ot_Ref02").parent().parent().show();
				} else if (!$j("#ot_Ref03").parent().parent().is(":visible")) {
					// $j("#ot_Ref03").show();
					$j("#ot_Ref03").parent().parent().show();
				}

				if ($j("#ot_Ref01").parent().parent().is(":visible") && $j("#ot_Ref02").parent().parent().is(":visible") && $j("#ot_Ref03").parent().parent().is(":visible")) {
					$j("#addDocument").hide();
				}
			});
		}

		///////////////////////////////////////////////

		{
			var _x = $j('#totalCompFolderAttached').html();
			if (!_x) {
				_x = 0;
			}
			if ($j('#ot_Ref04').val().length > 0) {
				_x++;
			}
			if ($j('#ot_Ref05').val().length > 0) {
				_x++;
			} else {
				$j('#ot_Ref05').parent().hide()
			}
			if ($j('#ot_Ref06').val().length > 0) {
				_x++;
			} else {
				$j('#ot_Ref06').parent().hide();
			}
			$j('#totalCompFolderAttached').html(_x);

			$j('#ot_Ref04').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_Ref04').val().length > 0) {
					x++;
				}
				if ($j('#ot_Ref05').val().length > 0) {
					x++;
				}
				$j('#totalCompFolderAttached').html(x);
			});
			$j('#ot_Ref05').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_Ref04').val().length > 0) {
					x++;
				}
				if ($j('#ot_Ref05').val().length > 0) {
					x++;
				}
				$j('#totalCompFolderAttached').html(x);
			});

			$j("#addCompFolder").click(function () {

				if (!$j("#ot_Ref04").parent().parent().is(":visible")) {
					$j("#ot_Ref04").parent().parent().show();
				} else if (!$j("#ot_Ref05").parent().parent().is(":visible")) {
					$j("#ot_Ref05").parent().parent().show();
				} else if (!$j("#ot_Ref06").parent().parent().is(":visible")) {
					$j("#ot_Ref06").parent().parent().show();
				}

				if ($j("#ot_Ref04").parent().parent().is(":visible") && $j("#ot_Ref05").parent().parent().is(":visible") && $j("#ot_Ref06").parent().parent().is(":visible")) {
					$j("#addCompFolder").hide();
				}
			});
		}

		///////////////////////////////////////////////

		{
			var _x = $j('#totalPhotoAttached').html();
			if (!_x) {
				_x = 0;
			}
			if ($j('#ot_Photo01').val().length > 0) {
				_x++;
			}
			if ($j('#ot_Photo02').val().length > 0) {
				_x++;
			} else {
				$j('#ot_Photo02').parent().hide()
			}
			if ($j('#ot_Photo03').val().length > 0) {
				_x++;
			} else {
				$j('#ot_Photo03').parent().hide();
			}
			$j('#totalPhotoAttached').html(_x);

			$j('#ot_Photo01').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_Photo01').val().length > 0) {
					x++;
				}
				if ($j('#ot_Photo02').val().length > 0) {
					x++;
				}
				$j('#totalPhotoAttached').html(x);
			});
			$j('#ot_Photo02').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_Photo01').val().length > 0) {
					x++;
				}
				if ($j('#ot_Photo02').val().length > 0) {
					x++;
				}
				$j('#totalPhotoAttached').html(x);
			});

			$j("#addPhoto").click(function () {

				if (!$j("#ot_Photo01").parent().parent().is(":visible")) {
					$j("#ot_Photo01").parent().parent().show();
				} else if (!$j("#ot_Photo02").parent().parent().is(":visible")) {
					$j("#ot_Photo02").parent().parent().show();
				} else if (!$j("#ot_Photo03").parent().parent().is(":visible")) {
					$j("#ot_Photo03").parent().parent().show();
				}

				if ($j("#ot_Photo01").parent().parent().is(":visible") && $j("#ot_Photo02").parent().parent().is(":visible") && $j("#ot_Photo03").parent().parent().is(":visible")) {
					$j("#addPhoto").hide();
				}
			});
        }
        
    // $j('[id$=dv_action_buttons] .btn-toolbar').append(
    //     '<div class="btn-group-vertical btn-group-lg" style="width: 100%;">' +
    //     '<button type="button" class="btn btn-default btn-lg" onclick="$j(\'[id$=_dv_form] :input\').attr(\'readonly\', false);$j(\'[id$=container]\').attr(\'disabled\', false);">' +
    //     '<i class="glyphicon glyphicon-edit"></i> Enable Edit</button>' +
    //     '</div>'
    // );

    // $j('[id$=_dv_form] :input').attr('readonly', true);

    // function readyFn(jquery) {
    //     $x = $j('[id$=_dv_form]');
    //     $j('[id$=container]').prop('disabled', true);
    //     $j('[id$=container]').attr('disabled', true);
    // }
    // jQuery(function() {
    //     setTimeout(function() {
    //         if (typeof(readyFn) == 'function') readyFn();
    //     }, 10); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
    // });
</script>