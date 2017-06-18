var updateProfile = function(){
  $.post("../PHP/get_user_profile.php", {}, function(data,status) {
    console.log(data);
    console.log(JSON.parse(data));
    var profileData = JSON.parse(data);
    $('#name').html(profileData.fullName + '\'s Profile');
    $('#email').html('Email Address: ' + profileData.email);
    $('#moneyInStockLock').html('Money in StockLock: $' + profileData.moneyInStockLock);
    $('#bankName').html('Bank: ' + profileData.bankName);
    $('#bankAccount').html('Bank Account: ' + profileData.bankAccount);
    $('#loading').hide();
  });
}

var insertMoreMoney = function(){
  var money = prompt('How much would you like to transfer in?');
  if(money != null){
    var password = prompt('Please enter your password');
    if(password != null){
      $.post("../PHP/bank_account_transfer.php", {amount:parseFloat(money), password:password}, function(data,status) {
        console.log(data);
        var confirmed = data == '1';
        if(confirmed){
          updateProfile();
          alert('Transfer Complete');
        }
        else {
          alert('Incorrect Password');
        }
      });
    }
  }
}

var removeMoney = function(){
  var money = prompt('How much would you like to transfer back to your bank account?');
  if(money != null){
    var password = prompt('Please enter your password');
    if(password != null){
      $.post("../PHP/bank_account_transfer.php", {amount:(parseFloat(money) * -1.0), password:password}, function(data,status) {
        console.log(data);
        var confirmed = data == '1';
        if(confirmed){
          updateProfile();
          alert('Transfer Complete');
        }
        else {
          alert('Incorrect Password');
        }
      });
    }
  }
}

$( document ).ready(function(){
  $('#loading').show();
  $('#moreMoney').click(function(){
    insertMoreMoney()
  });

  $('#transferMoneyBack').click(function(){
    removeMoney();
  });

  updateProfile();
});
