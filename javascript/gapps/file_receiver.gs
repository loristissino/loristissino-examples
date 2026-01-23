function doPost(e) {
  const FOLDER_ID = 'FOLDER_ID';
  // This could be stored in the Google Apps Settings...

  try {
    // 1. GET DATA
    var fileData = e.postData.contents;
    if (!fileData) throw new Error("No file data received.");

    // 2. DETERMINE MIME TYPE
    // Priority:
    // A. URL parameter (e.g., ?filetype=image/png) -> BEST for your Base64 workflow
    // B. The request header (e.postData.type) -> Fallback
    // C. Default
    var targetMimeType = e.parameter.filetype || e.postData.type || 'application/octet-stream';

    // 3. DECODE
    // We assume the incoming data is ALWAYS Base64 text now
    var decodedBytes = Utilities.base64Decode(fileData);

    // 4. FILENAME
    var filename = e.parameter.filename || 'upload_' + new Date().getTime();

    // 5. CREATE BLOB
    var finalBlob = Utilities.newBlob(decodedBytes, targetMimeType, filename);

    // 6. SAVE
    var folder = DriveApp.getFolderById(FOLDER_ID);
    var newFile = folder.createFile(finalBlob);

    return ContentService.createTextOutput(JSON.stringify({
      status: 'success',
      id: newFile.getId(),
      name: newFile.getName(),
      savedAs: newFile.getMimeType()
    })).setMimeType(ContentService.MimeType.JSON);

  } catch (err) {
    return ContentService.createTextOutput(JSON.stringify({
      status: 'error',
      message: err.toString()
    })).setMimeType(ContentService.MimeType.JSON);
  }
}
