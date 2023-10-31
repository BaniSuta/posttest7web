function validasiInput(event) {
      var keyCode = event.keyCode || event.which;
      var inputChar = String.fromCharCode(keyCode);
      var pattern = /[0-9\/]/;
      if (!pattern.test(inputChar)) {
        event.preventDefault();
      }
    }