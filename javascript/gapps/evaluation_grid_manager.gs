/* Copyright © Loris Tissino 2022-2023. */

const appName = 'EvaluationGridManager';
const markdownServiceUrl = '';  // Use an external service to translate Markdown content to HTML

const ss = SpreadsheetApp.getActiveSpreadsheet();
const configSheet = ss.getSheetByName("Config");

const ui = SpreadsheetApp.getUi();

const CONFIG_SENDERNAME_ROW       = 1;
const CONFIG_VALUES_ROW           = 2;
const CONFIG_OUTPUTFILE_ROW       = 3;
const CONFIG_EMAIL_SUBJECT_ROW    = 4;
const CONFIG_EMAIL_BODY_ROW       = 5;
const CONFIG_DOC_BODY_ROW         = 6;
const LIST_SELECTION_FIELD_COL    = 1;
const LIST_RESULT_FIELD_COL       = 2;
const LIST_FIRST_FIELD_COL        = 3;
const LIST_GIVEN_NAME_FIELD_COL   = 3;
const LIST_FAMILY_NAME_FIELD_COL  = 4;
const LIST_EMAIL_FIELD_COL        = 5;
const LIST_TOTAL_POINTS_FIELD_COL = 6;
const LIST_POINTS_MARKER_STRING   = '{points}';

let activeSheet;

function markdownToHtml(text, subject, standalone=true){
  let email = Session.getActiveUser().getEmail();
  let url = `${markdownServiceUrl}?author=${email}&title=${subject}`;
  if (standalone) {
    url += '&standalone=true';
  }
  let response = UrlFetchApp.fetch(url, {
  payload: text,
  method: 'POST'
});
  return response.getContentText();
}

function replacements(sheet, source, row){
  // replaces the text contained in *source* with the values 
  // contained in the *row*th row of *sheet*
  // it assumes that the keys to look for are in the first row
  // of *sheet*, starting from column LIST_FIRST_FIELD_COL
  
  let col=LIST_FIRST_FIELD_COL;
  let key='';
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
  prepareEmails(false, false);
}

function sendEmailsToSelf() {
  prepareEmails(false, true);
}

function testEmails() {
  prepareEmails(true, false);
}

function   selectSheetFromCurrentConfiguration() {
  activeSheet = ss.getSheetByName(configSheet.getRange(CONFIG_VALUES_ROW, 2).getValue());
}


function prepareEmails(dryRun, toSelf) {
  selectSheetFromCurrentConfiguration();

  const senderName = configSheet.getRange(CONFIG_SENDERNAME_ROW,2).getValue();

  let startRow = 2;  // First row of data to process

  const originalSubject=configSheet.getRange(CONFIG_EMAIL_SUBJECT_ROW,2).getValue();

  const originalHtmlBody = markdownToHtml(configSheet.getRange(CONFIG_EMAIL_BODY_ROW, 2).getValue(), originalSubject);

  const originalHtmlPageCode = markdownToHtml(configSheet.getRange(CONFIG_DOC_BODY_ROW, 2).getValue(), originalSubject, false, true);
  // for the web page, we want a partial content (not standalone) code with page breaks

  const outputFileName = configSheet.getRange(CONFIG_OUTPUTFILE_ROW,2).getValue();

  let htmlItems = [];

  let i=startRow;
  
  let count=0;
  
  let givenName='';
  let familyName='';
  let email='';
  let address='';
  let subject='';
  let htmlBody='';
  
  while(true)
  {
    email=activeSheet.getRange(i, LIST_EMAIL_FIELD_COL).getValue();
    
    if(!email)
    {
      break;
    }
    
    if(activeSheet.getRange(i, LIST_SELECTION_FIELD_COL).getValue()!=1)
    {
      i++;
      continue;
    }

    givenName = activeSheet.getRange(i,LIST_GIVEN_NAME_FIELD_COL).getValue();
    familyName = activeSheet.getRange(i,LIST_FAMILY_NAME_FIELD_COL).getValue();
    address = `${givenName} ${familyName} <${email}>`;
    
    subject=replacements(activeSheet, originalSubject, i);
    htmlBody=replacements(activeSheet, originalHtmlBody, i);    
    
    if(dryRun){
      Browser.msgBox('To: ' + address + "\n" +
                     'Subject: ' + subject + "\n" +
                     'Body' + "\n" +
                     htmlBody.replace(/<{1}[^<>]{1,}>{1}/g," ")
                    );
    }
    else
    {
      MailApp.sendEmail({
          to: toSelf ? Session.getActiveUser().getEmail() : email,
          subject: subject,
          htmlBody: htmlBody,
          name: senderName
        });
        Logger.log(email);

      if (outputFileName!='') {
        htmlItems.push(replacements(activeSheet, originalHtmlPageCode, i));
      }
    }

    activeSheet.getRange(i, LIST_RESULT_FIELD_COL).setValue(dryRun?"test":(toSelf?"to me":"to student"));
    count++;
    i++;
  }

  let htmlText = '';
  if (outputFileName!='') {
    htmlText = `<!DOCTYPE html>
  <html lang="it">
  <head>
      <meta charset="utf8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="${Session.getActiveUser().getEmail()}">
      <title>${outputFileName}</title>
  </head>
  <body style="padding: 56.7pt">
    `
    + htmlItems.join('<hr class="pb" style="display:none; page-break-after: always">')
    + '</body></html>';
  }

  if(dryRun){
    SpreadsheetApp.getActiveSpreadsheet().toast(`Job done, ${count} message(s) tested`, appName, 3);
  }
  else {
    SpreadsheetApp.getActiveSpreadsheet().toast(`Job done, ${count} message(s) sent`, appName, 3);
    if (outputFileName!='') {
      let doc = DriveApp.createFile(`${outputFileName}.html`, htmlText, MimeType.HTML);
      SpreadsheetApp.getActiveSpreadsheet().toast(`Job done, file ${doc.getName()} created`, appName, 3);
    }
  }
  
}
function computePoints () {
  selectSheetFromCurrentConfiguration();

  let startRow = 2;  // First row of data to process
  let i=startRow;
  let count=0;
  let email;
  while(true)
  {
    email=activeSheet.getRange(i,LIST_EMAIL_FIELD_COL).getValue();
    if(!email)
    {
      break;
    }

    activeSheet.getRange(i, LIST_TOTAL_POINTS_FIELD_COL).setBackground("white");
    if(activeSheet.getRange(i,1).getValue()!=1)
    {
      i++;
      continue;
    }

    activeSheet.getRange(i, LIST_TOTAL_POINTS_FIELD_COL).setValue(studentPoints(i)).setBackground('yellow');
    count++;
    i++;
  }
  
    SpreadsheetApp.getActiveSpreadsheet().toast(`Job done, computed points for ${count} student(s)`, appName, 3);
  
}

function studentPoints(row){
  let col = LIST_TOTAL_POINTS_FIELD_COL + 1;
  let points = 0;
  while (true) {
    let header = activeSheet.getRange(1,col).getValue();
    if (header==''){
      break;
    }
    activeSheet.getRange(row,col).setBackground("#DDDDDD");
    if (header.indexOf(LIST_POINTS_MARKER_STRING)>-1){
      let text = activeSheet.getRange(row,col).getValue();
      let value = parseInt(text.substring(0, text.indexOf(' -')));
      points += value;
      activeSheet.getRange(row,col).setBackground("#AADDAA");
    }
   col++;
  } 
  return points;
}

function onOpen() {
  var ss = SpreadsheetApp.getActiveSpreadsheet();
  var menuEntries = [ {name: "Calcola punteggi", functionName: "computePoints"},
                      {name: "Controlla la composizione dei messaggi", functionName: "testEmails"},
                      {name: "Spedisci le email a me", functionName: "sendEmailsToSelf"},
                      {name: "Spedisci le email agli indirizzi indicati", functionName: "sendEmails"},
                      ];
  ss.addMenu(appName, menuEntries);
}
