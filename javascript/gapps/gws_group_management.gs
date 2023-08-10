const ss = SpreadsheetApp.getActiveSpreadsheet();
const domain = ss.getSheetByName("Configuration").getRange("B1").getValue();
const gss = ss.getSheetByName("Groups");
const mss = ss.getSheetByName("Members");
const mogss = ss.getSheetByName("MembersOfGroups");

function onOpen() {
    ss.addMenu("Workspace", [
      {name: "List Groups", functionName: "listGroups"},
      {name: "List Members of Groups", functionName: "listMembersOfGroups"},
      {name: "Add Members to Groups", functionName: "addMembersToGroups"},
      {name: "Remove Members from Groups", functionName: "removeMembersFromGroups"}
    ]
  );
}

function listGroups() {
  let pageToken;
  let page;
  let row = 2;

  do {
      page = AdminDirectory.Groups.list({
      domain: domain,
      orderBy: 'email',
      pageSize: 100, 
      pageToken: pageToken}
      );

      page.groups.forEach(function(group) {
        if (gss.getRange(row, 1).getValue()){
        ss.toast("Skipping row " + row + ": not empty");
        }
      else {
        if (group.email.indexOf("20192020")==-1 && group.email.indexOf("20202021")==-1 && group.email.indexOf("20192020")==-1 && group.email.indexOf("20212022")==-1) {
          gss.getRange(row, 1).setValue(group.name);
          gss.getRange(row, 2).setValue(group.email);
      
          let members = AdminDirectory.Members.list(group.email).members; 
          gss.getRange(row, 3).setValue(members? members.length : 0);
          row++;
        } 
      }
      });
      pageToken = page.nextPageToken;
  } while (pageToken);
      

}

function listMembersOfGroups() {
      let grow = 2;
      let row = 2;
      let groupName;
      let groupEmail;
      while (true) {
         groupName = gss.getRange(grow, 1).getValue();
         groupEmail = gss.getRange(grow, 2).getValue();
      
         if (!groupName) {
            break;
         }

         let roster = "";
         if (groupEmail.toString().includes('cdc')){
           roster = groupEmail.toString().substring(4,8);
         }
      
         let members = AdminDirectory.Members.list(groupEmail).members;
         if (members) {
            members.forEach(function(member) {
            mogss.getRange(row, 1).setValue(groupName);
            mogss.getRange(row, 2).setValue(groupEmail);
            mogss.getRange(row, 3).setValue(member.email);
            try {
               let domainUser = AdminDirectory.Users.get(member.email);
               mogss.getRange(row, 4).setValue(Date.parse(domainUser.lastLoginTime)>0 ? 1: 0);
               mogss.getRange(row, 5).setValue(domainUser.name.givenName);
               mogss.getRange(row, 6).setValue(domainUser.name.familyName);
               mogss.getRange(row, 7).setValue(domainUser.lastLoginTime);
               let description = domainUser.organizations[0].description;
               // roster coordinator
               mogss.getRange(row, 5, 1, 2).clearFormat();
               mogss.getRange(row, 8).setValue("");
               if (description.includes(roster)){
                 mogss.getRange(row, 5, 1, 2).setFontWeight("bold");
                 mogss.getRange(row, 8).setValue("Coord.");
               }
            }
            catch(e) {
               mss.getRange(row, 4).setValue(e);
            }
            row++;
         });
      }
      
      grow++;
    }
}


function createGroups() {
  let count = 0;
  for (let row=2; true; row++) {
    let name = gss.getRange(row, 1).getValue();
    let email = gss.getRange(row, 2).getValue();
    if (email=='') {
      break;
    }
    
    if (email.indexOf("@")==-1){
      email += '@' + domain;
    }
    
    let group = false;
    try {
      group = AdminDirectory.Groups.get(email);
    }
    catch(e) {
      Logger.log(group + ": not found");
    }
    if (group) {
      Logger.log(group + " already present. Skipped");
      continue;
    }
    if (AdminDirectory.Groups.insert({
     "email": email,
     "name": name,
    })) {
      count++;
    }
  }
  ss.toast("Groups created: " + count, "Groups");
  
}


function addMembersToGroups() {
  let count = 0;
  for (let row=2; true; row++) {
    let group = mss.getRange(row, 1).getValue();
    let user = mss.getRange(row, 2).getValue();
    let role = mss.getRange(row, 3).getValue();
    let delivery_settings = mss.getRange(row, 4).getValue();
    if (group=='') {
      break;
    }
    if (group.indexOf("@")==-1){
      group += '@' + domain;
    }
    if (user.indexOf("@")==-1){
      user += '@' + domain;
    }
    
    try {
      let domainUser = AdminDirectory.Users.get(user);
    }
    catch(e) {
      mss.getRange(row, 5).setValue(e);
      continue;
    }
    
    let success = false;
    try {
      AdminDirectory.Members.insert({
        "kind": "admin#directory#member",
        "email": user,
        "role": role,
        "delivery_settings": delivery_settings
      }, group);
      success=true;
      mss.getRange(row, 5).setValue("inserted");
    }
    catch(e) {
      //Logger.log(e);
      mss.getRange(row, 5).setValue(e);
    }
    if (success) {
      count++
    }
  }
  ss.toast("Memberships created: " + count, "Memberships");
}

      
function removeMembersFromGroups() {
  let count = 0;
  for (let row=2; true; row++) {
    let group = mss.getRange(row, 1).getValue();
    let user = mss.getRange(row, 2).getValue();
    if (group=='') {
      break;
    }
    if (group.indexOf("@")==-1){
      group += '@' + domain;
    }
    if (user.indexOf("@")==-1){
      user += '@' + domain;
    }

    try {
      AdminDirectory.Members.remove(group, user)
      mss.getRange(row, 5).setValue("removed");
      count++;
    }
    catch(e) {
      mss.getRange(row, 5).setValue(e);
    }
    
  }
  ss.toast("Memberships removed: " + count, "Memberships");
}
  
