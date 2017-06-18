create table stocksBought(purchaseID integer auto_increment, userID integer, stockID integer, price double, numberBought integer, dateBought datetime, primary key(purchaseID)); 
create table stocksOwned(ownershipID integer auto_increment, userID integer, stockID integer, numberOfSharesOwned integer, primary key(ownershipID));
create table stocksSold(sellID integer auto_increment, userID integer, stockID integer, price double, numberSold integer, dateSold datetime, primary key(sellID));
create table symbols(stockID integer auto_increment, symbol varchar(50), primary key(stockID));
create table fundsTransfer(transferID integer auto_increment, userID integer, amountTransferred double, dateTransferred date, primary key(transferID));
create table users(userID integer auto_increment, firstName varchar(100), lastName varchar(100), email varchar(50), password varchar(50), bankRoutingNumber integer, bankAccountNumber varchar(50), accountBalance double, primary key(userID));