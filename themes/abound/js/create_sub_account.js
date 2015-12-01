
(function(window){

function IndexCtrl($scope,MainAccountService,SubAccountService){
	var currentController = this;
	$scope.message = "asdasd";
	$scope.mainAccounts = [];
	$scope.currentSubAccounts = [];
	$scope.filterTextMainAccount = "";
	$scope.selectedMainAccountKey = null;
	$scope.add_button_text = "Register";
	$scope.new_sub_account_username = "";
	$scope.new_sub_account_password = "";
	
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
		$scope.add_button_text = "Deleting sub account please wait";
		SubAccountService.deleteSubAccount(subAccountToDelete)
		.then(function(response){
			if (response.data.status == "ok") {
				$scope.add_button_text = "Add";
				alert('Sub account deleted');
				$scope.currentSubAccounts.splice(key, 1);
				$scope.new_sub_account_username = "";
				$scope.new_sub_account_password = "";
			}else{
				alert('Cant delete sub account . Try again later.');
			}
		}, function(error){
			alert(error.status+" : "+error.statusText+" . Access window.lastError for logs");
			window.lastError = error;
		});
	}
	this.registerSubAccount = function(subAccountObj){
		$scope.add_button_text = "Registering...Please wait...";
		var main_account_obj = $scope.selectedMainAccount;
		var subAccountObj ={
			username:$scope.new_sub_account_username,
			password:$scope.new_sub_account_password
		}

		SubAccountService.registerSubAccount(main_account_obj,subAccountObj)
		.then(function(response){
			if (response.data.status == "ok") {
				currentController.selectMainAccount($scope.selectedMainAccountKey);
				alert('Sub account registered');
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
	this.generateRandomSubAccount = function(){
		SubAccountService.generateRandomData()
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


	/*initialize main account*/
	MainAccountService.getMainAccount()
		.then(function(response){
			$scope.mainAccounts = response.data;
		}, function(error){
			alert(error.status+" : "+error.statusText+" . Access window.lastError for logs");
			window.lastError = error;
		});
}

function MainAccountService($http){
	this.getMainAccount = function(){
		return $http.get("/rest/mainAccount");
	}
	this.checkMainAccountStatus = function(){
		return $http.get("/rest/mainAccount/checkMainAccounts");
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
	this.generateRandomData = function(){
		return $http.get("/rest/subAccount/generateRandomData");
	}
}

angular.module('sub_account', [])
	.controller('IndexCtrl', ['$scope','MainAccountService','SubAccountService', IndexCtrl])
	.service('MainAccountService', ['$http', MainAccountService])
	.service('SubAccountService', ['$http',SubAccountService])
}(window));
