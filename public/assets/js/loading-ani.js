var LoadingPencarian = {
  init: function() {
      $("#loading_start1").click(function() {
          mApp.blockPage({
              overlayColor: "#000000",
              type: "loader",
              state: "success",
              message: "Memuat data..."
          }), setTimeout(function() {
              mApp.unblockPage()
          }, 2e3)
      }), $("#loading_start2").click(function() {
        mApp.blockPage({
            overlayColor: "#000000",
            type: "loader",
            state: "success",
            message: "Memuat data..."
        }), setTimeout(function() {
            mApp.unblockPage()
        }, 2e3)
    })
  }
};
jQuery(document).ready(function() {
  LoadingPencarian.init()
});