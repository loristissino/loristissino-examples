function RenameFilesPrependingStudentLastNames() {
  let folderId='1LUeUXHr_EEXHwiX..............................Hzn_9vXVoVK90useAPFOJkYh2fA';

  let folder = DriveApp.getFolderById(folderId);
  Logger.log(folder.getName());
  let files = folder.getFiles();
  while(files.hasNext()){
    let file = files.next();
    Logger.log(file.getName());
    Logger.log(file.getEditors());
    let viewers = file.getViewers();
    Logger.log(viewers);
    if (viewers.length>0){
      let v = viewers[0];
      Logger.log(v.getEmail());
      let email = v.getEmail();
      let surname = email.substring(email.indexOf('.')+1, email.indexOf('@'));
      if (file.getName().substring(0,1)!='§'){
        file.setName('§' + surname + ', ' + file.getName());
      }
      else {
        Logger.log("untouched");
      }
      Logger.log(surname);
    }
  }
}
