
(function(window){

function IndexCtrl($scope,MainAccountService,SubAccountService,growl){
	var currentController = this;
	$scope.message = "asdasd";
	$scope.mainAccounts = [];
	$scope.currentSubAccounts = [];
	$scope.filterTextMainAccount = "";
	$scope.selectedMainAccountKey = null;
	$scope.add_button_text = "Register";
	$scope.new_sub_account_username = "";
	$scope.new_sub_account_password = "";

	this.deleteCurrentMainAccount = function(mainAccountKey){
		var mainAccountToDelete = $scope.mainAccounts[mainAccountKey];
		if (confirm("Are you sure you want to delete this ? ")) {
			MainAccountService.deleteMainAccount(mainAccountToDelete)
			.then(function(response){
				if (response.data.status === "ok") {
					growl.success("Account deleted", {ttl:1000});
				}else{
					growl.error(response.data.message, {ttl:1000});
				}
			}).then(function(){
				/*refresh main accounts*/
				currentController.initializeMainAccount();
			});
		}
	}
	
	this.selectMainAccount = function(keyOfSelectedMainAccount){
		/*get selected main account*/
		$scope.selectedMainAccountKey = keyOfSelectedMainAccount;
		$scope.selectedMainAccount = $scope.mainAccounts[keyOfSelectedMainAccount];
		SubAccountService.getSubAccounts($scope.selectedMainAccount.id)
			.then(function(response){
				$scope.currentSubAccounts = response.data;
			}, function(error){
				alert(error.status+" : "+error.statusText+" . Access window.lastError for logs");
				window.lastError = error;
			});
	}
	this.deleteSubAccount = function(key,subAccountToDelete){
		growl.info("Deleting sub account please wait", {ttl:3000});
		SubAccountService.deleteSubAccount(subAccountToDelete)
		.then(function(response){
			if (response.data.status == "ok") {
				$scope.add_button_text = "Add";
				growl.success("Sub account deleted", {ttl:3000});
				$scope.currentSubAccounts.splice(key, 1);
				$scope.new_sub_account_username = "";
				$scope.new_sub_account_password = "";
			}else{
				growl.error('Cant delete sub account . Try again later.', {ttl:3000});
			}
		}, function(error){
			growl.error(error.status+" : "+error.statusText+" . Access window.lastError for logs", {ttl:3000});
			window.lastError = error;
		});
	}
	this.registerBulkSubAccount = function(){
		var numOfAccounts = prompt("Enter number of accounts to create ");
		numOfAccounts = parseInt(numOfAccounts);
		growl.info("Registering sub accounts. Please wait", {ttl:3000});
		SubAccountService.generateBulkAccounts($scope.selectedMainAccount ,numOfAccounts )
		.then(function(){
			growl.success("New sub accounts generated", {ttl:3000});
		})
		.then(function(){
			currentController.selectMainAccount($scope.selectedMainAccountKey);
			growl.info("Synchronising sub accounts", {ttl:3000});
		});
	}
	this.registerSubAccount = function(){
		growl.info("Registering sub account. Please wait.", {ttl:3000});
		var main_account_obj = $scope.selectedMainAccount;
		var subAccountObj ={
			username:$scope.new_sub_account_username,
			password:$scope.new_sub_account_password
		}

		SubAccountService.registerSubAccount(main_account_obj,subAccountObj)
		.then(function(response){
			if (response.data.status == "ok") {
				currentController.selectMainAccount($scope.selectedMainAccountKey);
				// alert('Sub account registered');
				$scope.new_sub_account_username = "";
				$scope.new_sub_account_password = "";
				
			}else{
				alert('Sorry cant register this time. Cause : '+response.data.message);
			}
			$scope.add_button_text = "Register";
		}, function(error){
			alert(error.status+" : "+error.statusText+" . Access window.lastError for logs");
			window.lastError = error;
		});
	}
	this.generateRandomSubAccount = function(mainAccount){
		SubAccountService.generateRandomData(mainAccount)
		.then(function(response){
			$scope.new_sub_account_username = response.data.username;
			$scope.new_sub_account_password = response.data.password;
		}, function(error){
			alert(error.status+" : "+error.statusText+" . Access window.lastError for logs");
			window.lastError = error;
		});
	}

	/*run main account status checker*/
	// MainAccountService.checkMainAccountStatus()
	// 	.then(function(){
	// 		//whatever happens , update get main account fresh data
	// 	});

	this.initializeMainAccount = function(){
		/*initialize main account*/
		MainAccountService.getMainAccount()
			.then(function(response){
				$scope.mainAccounts = response.data;
			}, function(error){
				alert(error.status+" : "+error.statusText+" . Access window.lastError for logs");
				window.lastError = error;
			});
	}
	this.initializeMainAccount();
}

function MainAccountService($http){
	this.getMainAccount = function(){
		return $http.get("/rest/mainAccount");
	}
	this.checkMainAccountStatus = function(){
		return $http.get("/rest/mainAccount/checkMainAccounts");
	}
	this.deleteMainAccount = function(mainAccount){
		return $http.post("/rest/mainAccount/delete",mainAccount);
	}
}
function SubAccountService($http){
	this.deleteSubAccount = function(subAccount){
		return $http.post("/rest/subAccount/delete",subAccount);
	}
	this.registerSubAccount = function( main_account_obj , subAccountObj){
		return $http.post("/rest/subAccount/register",{
			"main":main_account_obj,
			"sub":subAccountObj
		});
	}
	this.getSubAccounts = function(mainAccountId){
		return $http.post("/rest/subAccount",{
			'main_account':mainAccountId,
			'username':"",
			'password':""
		});
	}
	this.generateRandomData = function(mainAccount){
		return $http.post("/rest/subAccount/generateRandomData",mainAccount);
	}
	this.generateBulkAccounts = function(mainAccount,numOfAccounts){
		return $http.post("/rest/subAccount/generateBulkAccounts",{
			"main":mainAccount,
			"numOfAccounts":numOfAccounts,
		});
	}
}

angular.module('sub_account', ['angular-growl'])
	.controller('IndexCtrl', ['$scope','MainAccountService','SubAccountService','growl', IndexCtrl])
	.service('MainAccountService', ['$http', MainAccountService])
	.service('SubAccountService', ['$http',SubAccountService])
}(window));
