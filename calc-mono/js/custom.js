

jQuery(document).ready(function($){
 
$('.open-popup-link').magnificPopup({
  type:'inline',
  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
});


var 
	camera=1,
	nds=0,
	montag=0,
	sum=0,
	sum_camera_1=0,
	sum_camera_2=0;
	montag_work = 0;
	procent=0;

// var
// 	reg4 = 3600;
// 	reg8 = 10000;
// 	reg12 = 12810;

// 	montag_work_1 = 4158;
// 	montag_work_2 = 6237;

// 	out_camera = 5070;
// 	out_camera_full = 7605;
// 	in_camera = 4670;
// 	in_camera_full = 7005;

// 	hdd = 1800;
// 	montag_set = 3200;
// 	bp = 2650;

sum_all =0;
reg = 0;
val_set = 0;
sum_hdd = 0;
sum_bp =0;
camera_full = 0;
qq_sum_bp =0;
tip_reg4=0;
tip_reg8=0;
tip_reg12=0;

	//widget
	$("#camera, #nds").change(function(){
		if ($('#camera option:selected').val() == '1') {
		    camera_full = 1;
		    camera = 0; 
		    //alert(camera);
		};

		if ($('#camera option:selected').val() == '0') {
		    camera_full = 0;
		    camera = 1; 
		};

		if ($('#nds option:selected').val() == '0') {
		    nds = 0;
		};

		if ($('#nds option:selected').val() == '1') {
		    nds = 1;
		};
	});

	$("#montag1, #montag2, #montag3").change(function(){
			//montag_work = parseInt($('input[name=montag]:checked').val());
			if ($('input[name=montag]:checked').val() == 1) {
				montag_work = montag_work_1;
			}
			if ($('input[name=montag]:checked').val() == 2) {
				montag_work = montag_work_2;
			}

	});


	$("#sum_camera_1, #sum_camera_2").change(function(){
			sum_camera_1 = parseInt($('#sum_camera_1').val());
			sum_camera_2 = parseInt($('#sum_camera_2').val());
	});


	//result
	$("#montag1, #montag2, #montag3, #camera, #nds, #sum_camera_1, #sum_camera_2").change(function(){
		//$('#total6').val(nds+camera+montag+sum_camera_1+sum_camera_2);
	
		//formula
		sum_all = sum_camera_1+sum_camera_2;

		if ( sum_all <= 4) {
			reg = reg4;  //$('#r4').html(reg4);
			sum_bp = bp;
			qq_sum_bp=1;
			tip_reg4=1;
			tip_reg8=0;
			tip_reg12=0;
		}  else  if ( (sum_all>4) && (sum_all<=8) ) {
			reg = reg8; //$('#r8').val(reg);
			sum_bp = bp;
			qq_sum_bp=1;
			tip_reg4=0;
			tip_reg8=1;
			tip_reg12=0;
		} else if ( sum_all > 8){
			reg = reg12; //$('#r12').val(reg);
			sum_bp = bp*parseInt(sum_all/8)+bp;
			qq_sum_bp= parseInt(sum_all/8)+1;
			tip_reg4=0;
			tip_reg8=0;
			tip_reg12=1;
		} else if ( sum_all == 0){
			reg = 0;
		}

		// if ((tip_reg4==0)) {
		// 	$('.tr_reg4').css('display', 'none');
		// } else {
		// 	$('.tr_reg4').css('display', 'table-row');
		// }
		// if ((tip_reg8==0)) {
		// 	$('.tr_reg8').css('display', 'none');
		// } else {
		// 	$('.tr_reg8').css('display', 'table-row');
		// }
		// if ((tip_reg12==0)) {
		// 	$('.tr_reg12').css('display', 'none');
		// } else {
		// 	$('.tr_reg12').css('display', 'table-row');
		// }

		// registrator
		if ( (sum_all > 12) && (sum_all <= 16)){
			reg = reg12+reg4;
			tip_reg4=1;
			tip_reg8=0;
			tip_reg12=1; 
		}
		if ( (sum_all > 16) && (sum_all <= 20)){
			reg = reg12+reg4;
			tip_reg4=1;
			tip_reg8=0;
			tip_reg12=1;  
		}
		if ( (sum_all > 20) && (sum_all <= 24)){
			reg = reg12+reg8;
			tip_reg4=0;
			tip_reg8=1;
			tip_reg12=1;  
		}
		if ( (sum_all > 24) && (sum_all <= 32)){
			reg = reg12+reg12; 
			tip_reg4=0;
			tip_reg8=0;
			tip_reg12=2;  
		}
		// if ( (sum_all > 28) && (sum_all <= 32)){
		// 	reg = reg12+reg12+reg8; 
		// 	tip_reg4=0;
		// 	tip_reg8=1;
		// 	tip_reg12=2;
		// }
		if ( (sum_all > 32) && (sum_all <= 36)){
			reg = reg12+reg12+reg4;
			tip_reg4=1;
			tip_reg8=0;
			tip_reg12=2; 
		}
		if ( (sum_all > 36) && (sum_all <= 40)){
			reg = reg12+reg12+reg4;
			tip_reg4=0;
			tip_reg8=1;
			tip_reg12=2;   
		}
		if ( (sum_all > 40) && (sum_all <= 48)){
			reg = reg12+reg12+reg12; 
			tip_reg4=0;
			tip_reg8=0;
			tip_reg12=3;  
		}
		// if ( (sum_all > 44) && (sum_all <= 48)){
		// 	reg = reg12+reg12+reg12+reg12; 
		// 	tip_reg4=0;
		// 	tip_reg8=0;
		// 	tip_reg12=4;  
		// }
		//end

		//hdd
		if ( (sum_all <=16)){
			val_set = 1;
			sum_hdd = hdd*val_set;
		} else if ( (sum_all > 16) && (sum_all <=32)){
			val_set = 2;
			sum_hdd = hdd*val_set;
		} else if ( (sum_all >32)){
			val_set = parseInt(sum_all/16)+1;
			sum_hdd = hdd*val_set;
		}

		procent = parseInt((((
								sum_bp + 
								montag_set*sum_all + 
								sum_hdd + 
								(in_camera_full*sum_camera_2)*camera_full +
								(out_camera_full*sum_camera_1)*camera_full +
								(in_camera*sum_camera_2)*camera +
								(out_camera*sum_camera_1)*camera +
								reg +
								montag_work*sum_all
								)*18)/100)*nds);

		$('#total6').val(
						parseInt(
								sum_bp + 
								montag_set*sum_all + 
								sum_hdd + 
								(in_camera_full*sum_camera_2)*camera_full +
								(out_camera_full*sum_camera_1)*camera_full +
								(in_camera*sum_camera_2)*camera +
								(out_camera*sum_camera_1)*camera +
								reg +
								montag_work*sum_all +
								procent
								)
						);

	//});



	//$("#result, #print").click(function(event){
		// $("#rezult_all").html(parseInt(
		// 						sum_bp + 
		// 						montag_set*sum_all + 
		// 						sum_hdd + 
		// 						(in_camera_full*sum_camera_2)*camera_full +
		// 						(out_camera_full*sum_camera_1)*camera_full +
		// 						(in_camera*sum_camera_2)*camera +
		// 						(out_camera*sum_camera_1)*camera +
		// 						reg +
		// 						montag_work*sum_all +
		// 						procent
		// 						));
		//event.preventDefault();
		console.log('сумма Регистратор ' + reg);
		console.log('тип Регистратор tip_reg4:' + tip_reg4);
		console.log('тип Регистратор tip_reg8:' + tip_reg8);
		console.log('тип Регистратор tip_reg12:' + tip_reg12);
		$('#td_tip_reg4_col').html(tip_reg4);
		$('#td_tip_reg8_col').html(tip_reg8);
		$('#td_tip_reg12_col').html(tip_reg12);
		$('#td_tip_reg4_e').html(reg4);
		$('#td_tip_reg8_e').html(reg8);
		$('#td_tip_reg12_e').html(reg12);
		$('#td_tip_reg4_sum').html(tip_reg4*reg4);
		$('#td_tip_reg8_sum').html(tip_reg8*reg8);
		$('#td_tip_reg12_sum').html(tip_reg12*reg12);

		console.log('kol out_camera ' + sum_camera_1);
		console.log('kol in_camera ' + sum_camera_2);
		console.log('kol all camera sum' + sum_all); $('#td_sum_all').html(sum_all);

		console.log('out_camera ' + (out_camera*sum_camera_1)*camera);
		$('#td_out_camera_col').html(sum_camera_1*camera);
		$('#td_out_camera_e').html(out_camera);
		$('#td_out_camera_sum').html((out_camera*sum_camera_1)*camera);

		console.log('in_camera ' + (in_camera*sum_camera_2)*camera);
		$('#td_in_camera_col').html(sum_camera_2*camera);
		$('#td_in_camera_e').html(in_camera);
		$('#td_in_camera_sum').html((in_camera*sum_camera_2)*camera);


		console.log('out_camera_full ' + (out_camera_full*sum_camera_1)*camera_full);
		$('#td_out_camera_full_col').html(sum_camera_1*camera_full);
		$('#td_out_camera_full_e').html(out_camera_full);
		$('#td_out_camera_full_sum').html((out_camera_full*sum_camera_1)*camera_full);

		console.log('in_camera_full ' + (in_camera_full*sum_camera_2)*camera_full);
		$('#td_in_camera_full_col').html(sum_camera_2*camera_full);
		$('#td_in_camera_full_e').html(in_camera_full);
		$('#td_in_camera_full_sum').html((in_camera_full*sum_camera_2)*camera_full);

		console.log('sum_hdd ' + sum_hdd);$('#td_hdd_sum').html(sum_hdd);
		console.log('kol hdd ' + val_set);$('#td_hdd').html(val_set);
		$('#td_hdd_e').html(hdd);


		console.log('montag_set ' + montag_set*sum_all);
		$('#td_motag_set').html(sum_all);
		$('#td_motag_set_e').html(montag_set);
		$('#td_motag_set_sum').html(montag_set*sum_all);

		console.log('sum_bp ' + sum_bp);$('#td_bp_sum').html(sum_bp);
		console.log('kol bp' + qq_sum_bp );$('#td_bp_col').html(qq_sum_bp);
								$('#td_bp_e').html(bp);

		console.log('montag_work ' + montag_work);$('#td_motag_work_e').html(montag_work);
		console.log('sum montag_work ' + montag_work*sum_all);$('#td_motag_work_sum').html(montag_work*sum_all);

		console.log('procent ' + procent); $('#td_procent').html(procent);
		
		console.log('all == ' + parseInt(
					sum_bp + 
					montag_set*sum_all + 
					sum_hdd + 
					(in_camera_full*sum_camera_2)*camera_full +
					(out_camera_full*sum_camera_1)*camera_full +
					(in_camera*sum_camera_2)*camera +
					(out_camera*sum_camera_1)*camera +
					reg +
					montag_work*sum_all	+
					procent
					)
				); 

				td_all = parseInt(
					sum_bp + 
					montag_set*sum_all + 
					sum_hdd + 
					(in_camera_full*sum_camera_2)*camera_full +
					(out_camera_full*sum_camera_1)*camera_full +
					(in_camera*sum_camera_2)*camera +
					(out_camera*sum_camera_1)*camera +
					reg +
					montag_work*sum_all	+
					procent
					);	$('#td_all').html(td_all);
	});


});