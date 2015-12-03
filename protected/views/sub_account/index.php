<?php 
	$baseUrl = Yii::app()->theme->baseUrl; 
	Yii::app()->clientScript->registerCssFile($baseUrl.'/css/sub_account.css');



	/*angularjs*/
	Yii::app()->clientScript->registerScriptFile($baseUrl.'/bower_components/angularjs/angular.min.js', CClientScript::POS_END);
	/*angular extension*/	
	Yii::app()->clientScript->registerScriptFile($baseUrl.'/bower_components/angular-growl-v2/build/angular-growl.min.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerCssFile($baseUrl.'/bower_components/angular-growl-v2/build/angular-growl.min.css');
	/*angularjs clipboard*/
	Yii::app()->clientScript->registerScriptFile($baseUrl.'/bower_components/angular-clipboard/angular-clipboard.js', CClientScript::POS_END);


	/*my script*/
	Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/create_sub_account.js', CClientScript::POS_END);
	



?>
<div ng-app="sub_account">
	<div ng-controller="IndexCtrl as indexCtrl">
		<div growl></div>
		<div class="span3">
			<strong>Quick filter </strong>
			<ul class='quick-filter'>
				<li>
					<label>
						<input type="radio"  name='quickFilterMain' ng-click="filterTextMainAccount=''">
						None
					</label>
				</li>				
				<li>
					<label>
						<input type="radio"  name='quickFilterMain' ng-click="filterTextMainAccount='active'">
						Active
					</label>
				</li>
				<li>
					<label>
						<input type="radio"  name='quickFilterMain' ng-click="filterTextMainAccount='unconfirmed'">
						Unconfirmed
					</label>
				</li>
			</ul>
			<input type="search" class="form-control" required="required" title="" placeholder="Search Main account" style="width: 227px;padding: 13px;" ng-model="filterTextMainAccount">
			<h5>Displaying {{filteredAccounts.length}} of {{mainAccounts.length}} result/s.</h5>
			<ul class="nav nav-list bs-docs-sidenav" ng-repeat="(key, currentMainAccount) in fedAccounts = (mainAccounts | filter:{username:filterTextMainAccount})">
				<li ng-class="{ 'active':selectedMainAccountKey === key }">
					<a href="#dropdowns" ng-click="indexCtrl.selectMainAccount(key)">
						<div style="width:30px;float:left">
							<i class='pull-left' ng-click="indexCtrl.deleteCurrentMainAccount(key)">
								<span class=' icon-remove'></span>
							</i>
							<div class="clearfix"></div>
						</div>
						<div style="width: 190px;float:left">
							<i class='badge badge-info pull-right' ng-show="currentMainAccount.status === 'active'"><span class='icon-ok  icon-white'> </span></i>
							<i class='badge pull-right' ng-show="currentMainAccount.status	 === 'unconfirmed'"><span class=' icon-pause  icon-white'></span></i>
							{{currentMainAccount.username}}
							<div class="clearfix"></div>
							<small>{{currentMainAccount.time_ago}}</small>

						</div>
						<div class="clearfix"></div>
					</a>
				</li>
		    </ul>
		</div>
		<div class="span9 sub-account-main-container">
			<div class='well' ng-show="selectedMainAccountKey === null">
				<h1>
					Sub Account Panel
				</h1>
			</div>
			<div ng-show="selectedMainAccountKey !== null">
				<div class="well">
					<h3>
						<small>*You can click the link to copy to Clipboard</small> <br>
						Main Account : 
						<button title="click to copy to clipboard" clipboard text="selectedMainAccount.username" type='button' class='btn btn-link'>
							{{selectedMainAccount.username}}
						</button>
						<button title="click to copy to clipboard" clipboard text="selectedMainAccount.password" type='button' class='btn btn-link'>
							{{selectedMainAccount.password}}
						</button>
						
					</h3>
				</div>
				<p>
                <input type="text" class="search-query span6" placeholder="Quick filter" ng-model="subAccountFilterText">
				<strong class='pull-right'>Displaying {{currentSubAccountsFiltered.length}} of {{currentSubAccounts.length}} result/s.</strong>
				<br>
				</p>
				<h3>Sub Accounts</h3>
				<table class="table table-hover table-bordered">
					<thead>
						<th>Username</th>
						<th>Password</th>
						<th>Action</th>
					</thead>
					<tbody>
						<tr ng-show="currentSubAccounts.length === 0">
							<td colspan="3">
								No record found
							</td>
						</tr>
						<tr  ng-repeat="(key, value) in currentSubAccountsFiltered = (currentSubAccounts | filter:subAccountFilterText)" ng-show="currentSubAccounts.length !== 0">
							<td>{{value.username}}</td>
							<td>{{value.password}}</td>
							<td>
								<button type="button" class="btn btn-link" ng-click="indexCtrl.deleteSubAccount(key,value)">
									delete
								</button>
							</td>
						</tr>
						<tr>
							<td>
								<input type="text" class="form-control input-block" ng-model="new_sub_account_username">
							</td>
							<td>
								<input type="text" class="form-control" ng-model="new_sub_account_password">
							</td>
							<td>
								<div class="btn-group">
									<button ng-disabled="(!new_sub_account_username || new_sub_account_username.length == 0 ) || (!new_sub_account_password || new_sub_account_password.length == 0)" type="button" class="btn btn-default" ng-click="indexCtrl.registerSubAccount()">
										{{add_button_text}}
									</button>
									<button  type="button" class="btn btn-default" ng-click="indexCtrl.registerBulkSubAccount()">
										Bulk Sub User
									</button>

									<button type="button" class="btn btn-default" ng-click="indexCtrl.generateRandomSubAccount(selectedMainAccount)">
										Generate Sub User
									</button>
								</div>								
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>