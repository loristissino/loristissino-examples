/*
Adding this script to a Google Spreadsheet allows you to create events in Google Calendar.

The script expects a Sheet called "Events" with this columns:
Summary
Description
Start
End
Attendees
Status

Attendees is a comma separated list of email addresses.

Status is a column that will be filled with the result of the operation.

*/

function onOpen() {
  SpreadsheetApp.getUi()
    .createMenu('Calendario')
    .addItem('Aggiungi eventi', 'addEvents')
    .addToUi();
}

var dataSheet = SpreadsheetApp.getActiveSpreadsheet().getSheetByName(PropertiesService.getScriptProperties().getProperty('DataSheet'));

function addEvents() {
  
  let calendarId = 'primary';
  
  for (let row=2; true; row++) {
    let summary = dataSheet.getRange(row, 1).getValue();
    if (!summary) {
      return;
    }

    dataSheet.getRange(row, 6).setValue("creating event...");
    
    let description = dataSheet.getRange(row, 2).getValue();
    let start = dataSheet.getRange(row, 3).getValue();
    let end = dataSheet.getRange(row, 4).getValue();
    let attendees = peopleFromString(dataSheet.getRange(row, 5).getValue());
    
    let event = {
      summary: summary,
      description: description,
      start: {
        dateTime: start.toISOString()
      },
      end: {
        dateTime: end.toISOString()
      },
      attendees: attendees,
      // Red background. Use Calendar.Colors.get() for the full list.
      colorId: 11
    };
    
    try {
      // https://developers.google.com/apps-script/advanced/calendar
      Logger.log(JSON.stringify(Calendar.Events.insert(event, calendarId, {sendNotifications: true})));
      dataSheet.getRange(row, 6).setValue("created");
    }
    catch (e) {
      dataSheet.getRange(row, 6).setValue(e);
    }
    
  }
}

function peopleFromString(value) {
  let result = [];
  let values = value.split(",");
  values.forEach(function(v) {
    result.push({email: v.trim()});
  });
  return result;
}
