/*
 * This code allows mass mail in a Google spreadsheet
 * 
 * It assumes that there two sheets, Addresses and Configuration.
 * 
 * In the Addresses sheet there must be something like:
 * 
 *     A      B     C                   D               F        G
 * Selected	Sent	Name	          Email-address	     %field1%  %field2%
 *        1    0	Giuseppe Verdi	gv@example.com     v1        v2
 *        1    0  Maria Rossi     mr@example.com     v3        v4
 * 
 * Only the rows with a 1 in column A are considered.
 * You can choose any name for the variable fields.
 * 
 * 
 * In the Configuration sheet there must be something like:
 * 
 *    A                     B
 * Bcc	    myaddress@example.com
 * Subject	News for you, %field1%!
 * Body	    Hi, this is a sample, with custom values, like %field2%
 * 
 * Multiple line bodies are allowed in Google Apps spreadsheet
 * Just use ctrl-enter to have a new line.



Use at your own risk! This software comes with no warranty.

Copyright 2012 Loris Tissino, http://loris.tissino.it

*/



function replacements(sheet, source, row){
  // replaces the text contained in *source* with the values 
  // contained in the *row*th row of *sheet*
  // it assumes that the keys to look for are in the first row
  // of *sheet*, starting from column 5
  
  var col=5;
  var key='';
  while(true){
    key=sheet.getRange(1, col).getValue();
    if(!key){
      break;
    }
    source = source.replace(key, sheet.getRange(row, col).getValue(), 'g');
    col++;
  }
 return source;
}


function sendEmails() {
  prepareEmails(false);
}

function testEmails() {
  prepareEmails(true);
}


function prepareEmails(dryrun) {
  var addresses = SpreadsheetApp.getActiveSpreadsheet().getSheetByName("Addresses");
  var config = SpreadsheetApp.getActiveSpreadsheet().getSheetByName("Configuration");
  var startRow = 2;  // First row of data to process
  
  var bccaddress=config.getRange(1,2).getValue();

  var originalsubject=config.getRange(2,2).getValue();
  var originalbody=config.getRange(3, 2).getValue();

  var i=startRow;
  
  var count=0;
  
  var name='';
  var email='';
  var address='';
  var subject='';
  var body='';
  
  
  while(true)
  {
    address=addresses.getRange(i,3).getValue();
    
    if(!address)
    {
      break;
    }
    
    if(addresses.getRange(i,1).getValue()!=1)
    {
      i++;
      continue;
    }

    name = addresses.getRange(i,3).getValue(); 
    email = addresses.getRange(i,4).getValue();;
    address= name + ' <' + email + '>';
    
    subject=replacements(addresses, originalsubject, i);
    body=replacements(addresses, originalbody, i);    
    
    if(dryrun){
      Browser.msgBox('To: ' + address + "\n" +
                     'Subject: ' + subject + "\n" +
                     'Body' + "\n" +
                     body
                    );
    }
    else
    {
      MailApp.sendEmail(address, subject, body, { bcc: bccaddress } );
    }

    addresses.getRange(i, 2).setValue(1);
    count++;
    i++;
  }
  
  if(dryrun){
    SpreadsheetApp.getActiveSpreadsheet().toast('Job done, ' + count + ' message(s) tested', 'MassMailer', 3);
  }
  else {
    SpreadsheetApp.getActiveSpreadsheet().toast('Job done, ' + count + ' message(s) sent', 'MassMailer', 3);
  }
  
}



function onOpen() {
  var ss = SpreadsheetApp.getActiveSpreadsheet();
  var menuEntries = [ {name: "Send emails", functionName: "sendEmails"},
                      {name: "Test bodies", functionName: "testEmails"} ];
  ss.addMenu("MassMailer", menuEntries);
}


