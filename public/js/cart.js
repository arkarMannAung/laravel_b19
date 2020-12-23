var oldState=localStorage.getItem('shopcart');
$(document).ready(function(){
	// setInterval(watch, 1000);
	show();
	function show(){
		showCart();
		cartTable();
	}
	$("button[name='addToCart']").click(function(){
		var myLocal='shopcart';

		var myid =$(this).data('myid');
		var id =$(this).data('id');
		var code = $(this).data('code');
		var name = $(this).data('name');
		var photo = $(this).data('photo');
		var price = $(this).data('price');
		var discount = $(this).data('discount');
		var qty = check('id',id,myLocal); // usage for qty only
		var hit = search('id',id,myLocal); // return array no
		var myData={
			id:id,
			code:code,
			name:name,
			photo:photo,
			qty:qty,
			price:price,
			discount:discount
		};
		var local= localStorage.getItem(myLocal);
		if (local) {
			var myArray = JSON.parse(local);
			if (hit) {
				myArray[hit].qty=qty;
			} else {
				myArray.push(myData);
			}
		} else {
			var myArray=[];
			myArray.push(myData);
		}
		localStorage.setItem(myLocal, JSON.stringify(myArray));
		$(myid).html('Add to Cart'+' <small>x </small>'+qty);
		showCart();
	})

	function check(key,data,myLocal){
		var key=key;
		var data=data;
		var myLocal=myLocal;
		var qty=0;
		var myStorage = localStorage.getItem(myLocal);
		if (myStorage) {
			myArray=JSON.parse(localStorage.getItem(myLocal));
			var hit=false;
			for (x in myArray) {
				if (myArray[x][key]==data) {
					qty=myArray[x].qty+1;
					hit=true;
				}

			}
			if (!hit) {
				qty=1;
			}
		} else {
			qty=1;
		}
		return qty;
	}

	function search(key,data,myLocal){
		var key=key;
		var data=data;
		var myLocal=myLocal;
		var myStorage = localStorage.getItem(myLocal);
		var hit=false;
		if (myStorage) {
			myArray=JSON.parse(localStorage.getItem(myLocal));
			for (x in myArray) {
				if (myArray[x][key]==data) {
					hit=x;
				}

			}
		}
		return hit;
	}

	function showCart(){
		var myLocal = 'shopcart';
		var local=JSON.parse(localStorage.getItem(myLocal));
		var itemNo = 0;
		var itemTotal = 0;
		if (local) {
			for (e in local) {
				itemNo+=local[e].qty;
				if (local[e].discount=="") {
					itemTotal+=(local[e].qty*local[e].price);
				} else {
					itemTotal+=(local[e].qty*local[e].discount);
				}
				
			}
		}
		$("#itemNo").html(itemNo);
		$("#itemNo2").html(itemNo);
		$("#itemNo3").html(itemNo);
		$("#itemTotal").html(new Intl.NumberFormat('en-US').format(itemTotal)+' Ks'); //'en-IN'
	}

	function cartTable(){
		var myLocal = 'shopcart';
		var myArray=JSON.parse(localStorage.getItem(myLocal));
		if (myArray) {
			var	myHtml='';
			var subTotal=0;
			for (f in myArray) {
				if (myArray[f].discount=="") {
					var discount = new Intl.NumberFormat('en-US').format(myArray[f].price)+' Ks';	
					var price = '';
					var total = new Intl.NumberFormat('en-US').format((myArray[f].qty)*(myArray[f].price))+' Ks';
					subTotal+=(myArray[f].qty)*(myArray[f].price);	
				} else {
					var price = new Intl.NumberFormat('en-US').format(myArray[f].price)+' Ks';
					var discount = new Intl.NumberFormat('en-US').format(myArray[f].discount)+' Ks';
					var total = new Intl.NumberFormat('en-US').format((myArray[f].qty)*(myArray[f].discount))+' Ks';
					subTotal+=(myArray[f].qty)*(myArray[f].discount);	
				}

				
				myHtml+=`<tr>
							<td class="align-middle text-center">
								<button data-id='${f}' name='cartDel' class="btn btn-outline-danger remove btn-sm" style="border-radius: 50%"> 
									<i class="icofont-close-line"></i> 
								</button> 
							</td>
							<td class="align-middle text-center"> 
								<img src="${myArray[f].photo}" class="cartImg">						
							</td>
							<td class="align-middle"> 
								<p> ${myArray[f].name} </p>
								<p> ${myArray[f].code} </p>
							</td>
							<td class="align-middle text-center">
								<button data-id='${f}' name='cart+' class="btn btn-outline-secondary plus_btn"> 
									<i class="icofont-plus"></i> 
								</button>
							</td>
							<td class="align-middle text-center">
								<p> ${myArray[f].qty} </p>
							</td>
							<td class="align-middle text-center">
								<button data-id='${f}' name='cart-' class="btn btn-outline-secondary minus_btn"> 
									<i class="icofont-minus"></i>
								</button>
							</td>
							<td class="align-middle text-right">
								<p class="text-danger"> 
									${discount}
								</p>
								<p class="font-weight-lighter"> 
								<del> ${price} </del> </p>
							</td>
							<td class="align-middle text-right">
								${total}
							</td>
						</tr>`;
			}
		var	myHtml2=`				
						<td colspan="8">
							<h3 class="text-right"> Total : ${new Intl.NumberFormat('en-US').format(subTotal)} Ks </h3>
						</td>
					`;
			$('#shoppingcart_table').html(myHtml);
			$('#shoppingcart_tfoot').html(myHtml2);
		} else {
			myHtml=`					
					<div class="col-12">
						<h5 class="text-center"> There are no items in this cart </h5>
					</div>				
				`;
			$('#cartTable').html(myHtml);
		}
	}

	$(document).on('click','button[name="cartDel"]',function(){
		var id=$(this).data('id');
		remove(id);	
	})
	$(document).on('click','button[name="cart+"]',function(){
		var id=$(this).data('id');
		var tempCart = 'shopcart';
		var myArray = JSON.parse(localStorage.getItem(tempCart));
		myArray[id].qty=myArray[id].qty+1;
		localStorage.setItem(tempCart, JSON.stringify(myArray));
		show();
	})
	$(document).on('click','button[name="cart-"]',function(){
		var id=$(this).data('id');
		var tempCart = 'shopcart';
		var myArray = JSON.parse(localStorage.getItem(tempCart));
		if (myArray[id].qty!=1) {
			myArray[id].qty=myArray[id].qty-1;
			localStorage.setItem(tempCart, JSON.stringify(myArray));
		} else {
			remove(id);
		}
		show();
	})
	function remove(id){
		var ans = confirm("Are you want to delete this item?");
		if (ans) {
			var myLocal = 'shopcart';
			var myArray = JSON.parse(localStorage.getItem(myLocal));
			var id = id;
			myArray.splice(id, 1);
			if (myArray.length==0) {
				localStorage.removeItem(myLocal);
			} else {
				localStorage.setItem(myLocal, JSON.stringify(myArray));	
			}
			show();
		}
	}

	// function watch(){
	// 	// var myLocal = 'shopcart';
	// 	// var now = localStorage.getItem(myLocal);
	// 	// if (oldState!=now) {
	// 	// 	oldState=now;
	// 	// 	show();
	// 	// }

 //        $.ajax({
 //            method:'POST',
 //            url:'session_reg.php',
 //            data:{req:'time'},
 //            success:function(res){
 //                if (res=='0') {
 //                	// not login or admin
 //                	// console.log('no login');
 //                } else {
 //                	// console.log(res);
 //                	if (res>=300) {
 //                		$.ajax({
 //                			method:'POST',
 //                			url:'session_reg.php',
 //                			data:{req:'timeout'},
 //                			success:function(ans){
 //                				if (ans=='done') {
 //                					location.href = 'login.php';
 //                				}
 //                			}
 //                		});
                		
 //                	}
 //                }            
 //            }
 //        });
	// }
})
