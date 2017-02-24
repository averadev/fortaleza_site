<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/reservas/css/jqueryui/theme/aristo/jquery-ui-all.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/reservas/css/plugins/anythingslider/anythingslider.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/reservas/css/plugins/validate/validate.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/reservas/css/plugins/spinnercontrol/jquery.spinnercontrol.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/reservas/css/plugins/datepicker-widgit/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/reservas/css/main.css"/>

<script type="text/javascript">
var CURRENCY = '<?php echo CURREN; ?>';

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/modernizr/modernizr-1.5.min.js" ></script>   
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/jqueryui/theme/aristo/jquery-ui-all.min.js"></script>    
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/datepicker/ui.datepicker-es.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/json/jquery.json.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/anythingslider/jquery.anythingslider.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/validate/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/jtemplates/jquery-jtemplates.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/jshashtable/jshashtable.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/format/jquery.format.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/numberformatter/jquery.numberformatter.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/spinnercontrol/jquery.spinnercontrol.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/blockui/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/datepicker-widgit/lang/es.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/datepicker-widgit/datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/sales/jquery.reserve.js"></script>

<div id="appConteiner">

	<ul id="sliderBoxNav">
		<li class="navItem"> <input type="hidden" class="indexPanel" value="1" /></li>
		<li class="navItem"> <input type="hidden" class="indexPanel" value="2" /></li>
		<li class="navItem"> <input type="hidden" class="indexPanel" value="3" /></li>
		<li class="navItem"> <input type="hidden" class="indexPanel" value="4" /></li>			
	</ul>
	
	<div id="sliderBox">
	
		<!-- Panel 1-->
		<div id="panel1">		
			<div class="panelTitle"></div>
			<div class="leftSide" style="margin-left: 100px;">										
				<form id="formReservation">
					<table>
						<tr>
							<td> <label for="arriveDate">Arrival: </label>				</td>
							<td> <input id="arriveDate" name="arriveDate" readonly="readonly" />		</td>
						</tr>
						<tr>
							<td> <label for="departureDate">Departure:</label>			</td>
							<td> <input id="departureDate" name="departureDate" readonly="readonly"/>	</td>
						</tr>
						<tr>
							<td> <label for="nRooms">Rooms:</label> </td>						
							<td> 
								<select id="selRooms" name="nRooms">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>								
								 </select>								 
							</td>					
						</tr>
						<tr>
							<td colspan="2">
								<div id="peopleBox" >
									<div id="nPeople1" class="nPeople">
										<div class="adultBox">
											<label for="nAdults">Adults:</label>
											<select id="selAdults1" name="nAdults">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>																	
											</select>
										</div>
										<div class="childBox">
											<label for="nChildren">Children:</label>
											<select id="selChildren1" name="nChildren">
												<option value="0">0</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>																	
											</select>
										</div>
										<div class="childAgeBox">
											*Children are defined between 3 and 12 years old.<br/>
											*Children under 3 are free.<br/>
											*Over 12 years charged as adult.<br/>
										</div> <br/>
									</div>
								</div>
							</td>		
						</tr>
					</table>
				</form>
				
			</div>
			<div class="rightSide">				
				<div id="nextIcon1" class="nextButtom">
					<input type="hidden" class="panelIndex" value="1" />
				</div>
			</div>
		</div>
		
		<!-- Panel 2-->
		<div id="panel2" >
			<div class="panelTitle"></div>			
			<div class="leftSide">				
				<div>
					<div id="reserveRange"></div>
					<div id="reserveTotal">Total $ 0,000.00</div>
				</div>
				<div style="font-size: smaller; text-align: right;">*Prices do not include Service Fee &amp; Room tax</div>
				<div id="roomConteiner"></div>				
			</div>		
			<div class="rightSide">	
				<div id="nextIcon2" class="nextButtom">					
					<input type="hidden" class="panelIndex" value="2" />				
				</div>				
			</div>
		</div>
		<!-- Panel 3-->
		<div id="panel3">
			<div class="panelTitle"></div>
			<div class="leftSide">
				<div id="customerInfo">
					<div id="cFormTitle">Customer Data </div>
					<form id="formCustomer">						
						<table style="width:650px;">
							<tr>
								<td> <label for="cName">Name:</label> </td>
								<td> <input type="text" id="cName" name="cName" /> </td>
								<td> <label for="cPaterno">Last Name(1):</label> </td>
								<td> <input type="text" id="cPaterno" name="cPaterno"/></td>
							</tr>
							
							<tr>
								<td> <label for="cMaterno">Last Name(2):</label> </td>
								<td> <input type="text" id="cMaterno" name="cMaterno" /> </td>
								<td> <label for="cAddress">Country:</label></td>
								<td> <input type="text" id="cAddress" name="cAddress" /> </td>											
							</tr>						
							<tr>
								<td> <label for="cPhone">Phone:</label> </td>
								<td> <input type="text" id="cPhone" name="cPhone" /> </td>
								<td> <label for="cEmail">E-mail:</label> </td>
								<td> <input type="text" id="cEmail" name="cEmail" /> </td>										
							</tr>
						</table>
					</form>
				</div>
			</div>
			<div class="rightSide">
				<div id="nextIcon3" class="nextButtom">				
					<input type="hidden" class="panelIndex" value="3" />				
				</div>				
			</div>				
		</div>
		<!-- Panel 4-->
		<div id="panel4">
			<div class="panelTitle"></div>			
				
				<div id="totalData">
					<div id="generalData"></div>
					<div id="generalPrice">
						<div id="subTotal">Total: $ 0,000.00</div>						
						<div id="serviceFee"></div>
						<div id="roomTax"></div>
						<div id="reservePrice">Total: $ 0,000.00</div>
						<div id="reserveCode">Cod. de Reservation: 123456</div>
						<div id="doPayPal" style="display: none; color: red; font-size: small;">*In order to confirm you reservation your booking must be paid in full. 
							<br/>Otherwise we do not guarantee your stay.</div>
					</div>
				</div>
															
				<div id="roomSummary" class="leftSide">			
					<div id="reserveSummary"></div>				
				</div>
				
				<div class="rightSide">					
					<div id="nextIcon4" class="nextButtom">				
						<input type="hidden" class="panelIndex" value="3" />
						<input type="hidden" id="reserved" name="reserved" value="0" />
					</div>
					<!-- Paypal -->
					<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">						
					
						<input type="hidden" name="cmd" value="_xclick" />
						<input type="hidden" name="business" value="fortalezasuites@hotmail.com" />
						
						<!-- Importante -->
						<input type="hidden" id="ppItemName" name="item_name" value="" />
						<input type="hidden" id="ppItemNumber" name="item_number" value="" />
						<input type="hidden" id="ppAmount" name="amount" value="" />
						<!--  --> 
						
						<input type="hidden" name="notify_url" value="<?php echo base_url(); ?>reserveController/paySuccess" />
						<input type="hidden" name="no_shipping" value="1" />
						<input type="hidden" name="return" value="<?php echo base_url(); ?>" />
						<input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>" />
						<input type="hidden" name="no_note" value="1" />
						<input type="hidden" name="currency_code" value="<?php echo CURREN; ?>" />
						<input type="hidden" name="bn" value="PP-BuyNowBF" />
						<input type="image"  id="btnPay" src="<?php echo base_url(); ?>assets/reservas/images/pp_icon.png" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" width="300" height="220">
						<div id="legendPaypal">*Make your payment with PayPal</div>						
					</form>
					
					
				</div>							
		</div>
	</div>
</div>
