function copyData(text){
    navigator.clipboard.writeText(text).then(
        function() {
          /* clipboard successfully set */
          window.alert('Success! api_key copied to clipboard')
        },
        function() {
          /* clipboard write failed */
          window.alert('Opps! Your browser does not support the Clipboard API')
        }
      )
}

export default copyData(text);
