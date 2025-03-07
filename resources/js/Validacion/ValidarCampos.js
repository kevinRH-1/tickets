function isValidFicha(ficha) {
    return isOnlyNumbers(ficha) && ficha.length === 4;
  }

function isOnlyLetters(str) {
    const regex = /^[a-zA-Z\s]+$/;
    return regex.test(str);
  }
  
  function isOnlyNumbers(str) {
    //const regex = /^[0-9]+$/;
    const regex = /^[0-9]{4}$/;
    return regex.test(str);
  }
  
  function isValidEmail(str) {
    const regex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    return regex.test(str);
  }
  
  function isValidPhoneNumber(str) {
    const regex = /^[0-9+]{7,15}$/;
    return regex.test(str);
  }

  function formatPhoneNumber(phoneNumber) {
    const cleanedPhoneNumber = phoneNumber.replace(/[^0-9+]/g, '');
    const phoneLength = cleanedPhoneNumber.length;
  
    if (phoneLength < 4) return cleanedPhoneNumber;
    if (phoneLength < 8) return `${cleanedPhoneNumber.slice(0, 4)}-${cleanedPhoneNumber.slice(4)}`;
  
    return `${cleanedPhoneNumber.slice(0, 4)}-${cleanedPhoneNumber.slice(4, 7)}-${cleanedPhoneNumber.slice(7, 11)}`;
  }
  
  function isValidUsername(str) {
    const regex = /^[a-zA-Z0-9_]{4,16}$/;
    return regex.test(str);
  }
  