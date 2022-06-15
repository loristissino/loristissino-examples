/*
 * This code allows customized mass mailing from a Google spreadsheet
 * 
 * It assumes that in the current sheet of a Google Spreasheet the first
 * lines have the following contents:
 * 
 * Cell B1: the subject of the message
 * Cell B2: the plain text body of the message
 * Cell B3 (optional): the HTML body of the message
 * Cell B4 (optional): one or more IDs of Google Drive files that have
 *          to be sent 
 * 
 * Multiple line bodies are allowed in Google Apps spreadsheet
 * Just use ctrl-enter to have a new line inside a cell.
 * 
 * The recipient addresses have to be put in the lines starting from 7
 * 
 *     A      B     C                   D               E        F
 * Selected	Sent	Name	          Email-address	     %field1%  %field2%
 *        1    0  Giuseppe Verdi  gv@example.com     v1        v2
 *        1    0  Maria Rossi     mr@example.com     v3        v4
 * 
 * Only the rows with a 1 in column A are considered.
 * You can choose any names for the variable fields.
 * 
 * Both subject and body of the message will be searched for the fields
 * listed from column E onward. The field name will be replaced with
 * the value of the line considered.
 * 
 * Subject  News for you, %field1%!
 * Body     Hi, this is a sample, with custom values, like %field2%
 * 
 * Use at your own risk! This software comes with no warranty.
 * 

Copyright 2012-2022 Loris Tissino

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

*/


function replacements(sheet, source, row){
  // replaces the text contained in *source* with the values 
  // contained in the *row*th row of *sheet*
  // it assumes that the keys to look for are in the first row
  // of *sheet*, starting from column 5
  
  let col=5;
  let key='';
  while(true){
    key=sheet.getRange(6, col).getValue();  //headers are in the 6th row
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
  let sheet = SpreadsheetApp.getActiveSpreadsheet().getActiveSheet();
  let startRow = 6;  // First row of data to process
  
  let originalSubject=sheet.getRange(1,2).getValue();
  let originalPlainTextBody=sheet.getRange(2, 2).getValue();
  let originalHtmlBody=sheet.getRange(3, 2).getValue();
  let attachmentsIds=sheet.getRange(4, 2).getValue();

  let i=startRow;
  
  let count=0;
  
  let name='';
  let email='';
  let address='';
  let subject='';
  let body='';
  let htmlText='';
  
  while(true)
  {
    address=sheet.getRange(i,3).getValue();
    
    if(!address)
    {
      break;
    }
    
    if(sheet.getRange(i,1).getValue()!=1)
    {
      i++;
      continue;
    }

    name = sheet.getRange(i,3).getValue(); 
    email = sheet.getRange(i,4).getValue();;
    address= name + ' <' + email + '>';
    
    subject=replacements(sheet, originalSubject, i);
    body=replacements(sheet, originalPlainTextBody, i);
    htmlText=replacements(sheet, originalHtmlBody, i);
    
    if(dryrun){
      Browser.msgBox('To: ' + address + "\n" +
                     'Subject: ' + subject + "\n" +
                     'Body' + "\n" +
                     body
                    );
    }
    else
    {
      let options = {
        attachments: []
      };

      if (htmlText) {
        options.htmlBody = htmlText;
      }

      let ids = attachmentsIds.split(",").map(x => x.trim());
      for (let i in ids) {
        let attachment = DriveApp.getFileById(ids[i]);
        if (attachment) {
          options.attachments.push(attachment);
        }
      }

      MailApp.sendEmail(address, subject, body, options);
    }

    sheet.getRange(i, 2).setValue(1);
    count++;
    i++;
  }
  
  SpreadsheetApp.getActiveSpreadsheet().toast(
    'Job done, ' + count + (dryrun? ' message(s) tested': ' message(s) sent'), 'MassMailer',
     3
  );
    
}



function onOpen() {
  var ss = SpreadsheetApp.getActiveSpreadsheet();
  var menuEntries = [ {name: "Send emails", functionName: "sendEmails"},
                      {name: "Test bodies", functionName: "testEmails"} ];
  ss.addMenu("MassMailer", menuEntries);
}

