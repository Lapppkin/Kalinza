{"version":3,"sources":["script.js"],"names":["window","BX","namespace","Sender","Mail","Editor","Helper","changeDisplay","node","isShow","style","display","prototype","init","params","this","id","input","inputId","placeHolders","mess","context","containerId","blockNode","querySelector","plainNode","inputNode","addCustomEvent","onEditorInitedBefore","bind","onEditorInitedAfter","Template","Selector","selector","events","templateSelect","onTemplateSelect","template","isOnDemand","messageFields","some","field","code","onDemand","uri","getTemplateRequestingUri","setTemplateUri","forEach","setContent","value","isTargetEditor","editor","indexOf","components","SetComponentIcludeMethod","extend","PlaceHolderSelectorList","BXHtmlEditor","DropDownList","Controls","onPlaceHolderSelectorListCreate","onGetControlsMap","controlsMap","push","compact","hidden","sort","checkWidth","offsetWidth","placeHolderSelectorList","isSupportedTemplateUri","isShowedBlock","confirmTemplateChange","BlockEditorManager","get","load","switchView","confirm","changeTemplate","isShowBlock","content","wrap","title","placeHolderTitle","superclass","constructor","apply","arguments","action","zIndex","On","disabledForTextarea","arValues","i","CODE","name","NAME","topName","DESC","className","Create","pCont","innerHTML","appendChild","GetCont","setTimeout","Message","setAdaptedInstance"],"mappings":"CAAC,SAAWA,GAEXC,GAAGC,UAAU,kBACb,GAAID,GAAGE,OAAOC,KAAKC,OACnB,CACC,OAID,IAAIC,GACHC,cAAe,SAAUC,EAAMC,GAE9B,IAAKD,EACL,CACC,OAGDA,EAAKE,MAAMC,QAAUF,EAAS,GAAK,SAQrC,SAASJ,KAGTA,EAAOO,UAAUC,KAAO,SAAUC,GAEjCC,KAAKC,GAAKF,EAAOE,GACjBD,KAAKE,MAAQhB,GAAGa,EAAOI,SACvBH,KAAKI,aAAeL,EAAOK,aAC3BJ,KAAKK,KAAON,EAAOM,KAEnBL,KAAKM,QAAUpB,GAAGa,EAAOQ,aACzBP,KAAKQ,UAAYR,KAAKM,QAAQG,cAAc,0BAC5CT,KAAKU,UAAYV,KAAKM,QAAQG,cAAc,0BAC5CT,KAAKW,UAAYX,KAAKU,UAAUD,cAAc,mBAG9CvB,GAAG0B,eAAe,uBAAwBZ,KAAKa,qBAAqBC,KAAKd,OACzEd,GAAG0B,eAAe,sBAAuBZ,KAAKe,oBAAoBD,KAAKd,OAEvE,GAAId,GAAGE,OAAO4B,UAAY9B,GAAGE,OAAO4B,SAASC,SAC7C,CACC,IAAIC,EAAWhC,GAAGE,OAAO4B,SAASC,SAClC/B,GAAG0B,eAAeM,EAAUA,EAASC,OAAOC,eAAgBpB,KAAKqB,iBAAiBP,KAAKd,SAGzFV,EAAOO,UAAUwB,iBAAmB,SAAUC,GAE7C,IAAIC,EAAaD,EAASE,cAAcC,KAAK,SAAUC,GACtD,OAAQA,EAAMC,OAAS,WAAaD,EAAME,WAE3C,GAAIL,EACJ,CACC,IAAIM,EAAM3C,GAAGE,OAAO4B,SAASC,SAASa,yBAAyBR,GAC/DtB,KAAK+B,eAAeF,OAGrB,CACCP,EAASE,cAAcQ,QAAQ,SAAUN,GACxC,GAAGA,EAAMC,OAAS,UAClB,CACC,OAED3B,KAAKiC,WAAWP,EAAMQ,QACpBlC,QAGLV,EAAOO,UAAUsC,eAAiB,SAAUC,GAE3C,IAAKA,EACL,CACC,OAAO,MAGR,OAAOA,EAAOnC,GAAGoC,QAAQ,6BAA+B,GAEzD/C,EAAOO,UAAUkB,oBAAsB,SAAUqB,GAEhD,IAAKpC,KAAKmC,eAAeC,GACzB,CACC,OAGDA,EAAOE,WAAWC,yBAAyB,gDAE5CjD,EAAOO,UAAUgB,qBAAuB,SAAUuB,GAEjD,IAAKpC,KAAKmC,eAAeC,GACzB,CACC,OAGDlD,GAAGsD,OAAOC,EAAyBxD,EAAOyD,aAAaC,cACvD1D,EAAOyD,aAAaE,SAAS,wBAA0BH,EAEvDvD,GAAG0B,eACFwB,EACA,gCACApC,KAAK6C,gCAAgC/B,KAAKd,OAE3Cd,GAAG0B,eACFwB,EACA,iBACApC,KAAK8C,iBAAiBhC,KAAKd,QAG7BV,EAAOO,UAAUiD,iBAAmB,SAAUC,GAE7CA,EAAYC,MACX/C,GAAI,uBACJgD,QAAS,KACTC,OAAQ,MACRC,KAAM,EACNC,WAAY,MACZC,YAAa,MAGf/D,EAAOO,UAAUgD,gCAAkC,SAAUS,GAE5DA,EAAwBlD,aAAeJ,KAAKI,cAE7Cd,EAAOO,UAAU0D,uBAAyB,WAEzC,OAAO,MAERjE,EAAOO,UAAUkC,eAAiB,SAASF,GAE1C,GAAI7B,KAAKE,MAAMgC,QAAUlC,KAAKwD,kBAAoBxD,KAAKyD,wBACvD,CACC,OAGDvE,GAAGwE,mBAAmBC,IAAI3D,KAAKC,IAAI2D,KAAK/B,GACxC7B,KAAK6D,WAAW,OAEjBvE,EAAOO,UAAU2D,cAAgB,WAEhC,OAAOxD,KAAKQ,UAAUb,MAAMC,UAAY,QAEzCN,EAAOO,UAAU4D,sBAAwB,WAExC,OAAOK,QAAQ9D,KAAKK,KAAK0D,iBAE1BzE,EAAOO,UAAUgE,WAAa,SAASG,GAEtCzE,EAAOC,cAAcQ,KAAKQ,UAAWwD,GACrCzE,EAAOC,cAAcQ,KAAKU,WAAYsD,IAEvC1E,EAAOO,UAAUoC,WAAa,SAASgC,GAEtC,GAAIjE,KAAKwD,kBAAoBxD,KAAKyD,wBAClC,CACC,OAGDzD,KAAKW,UAAUuB,MAAQ+B,EACvBjE,KAAK6D,WAAW,QAIjB,SAASpB,EAAwBL,EAAQ8B,GAExC,IAAIC,EAAQjF,GAAGE,OAAOC,KAAKC,OAAOe,KAAK+D,iBAEvC3B,EAAwB4B,WAAWC,YAAYC,MAAMvE,KAAMwE,WAC3DxE,KAAKC,GAAK,uBACVD,KAAKmE,MAAQA,EACbnE,KAAKyE,OAAS,aACdzE,KAAK0E,OAAS,KAEd1E,KAAKI,gBACLgC,EAAOuC,GAAG,iCAAkC3E,OAE5CA,KAAK4E,oBAAsB,MAC3B5E,KAAK6E,YAEL,IAAK,IAAIC,KAAK9E,KAAKI,aACnB,CACC,IAAI8B,EAAQlC,KAAKI,aAAa0E,GAC9B5C,EAAMA,MAAQ,IAAMA,EAAM6C,KAAO,IACjC/E,KAAK6E,SAAS7B,MAEZ/C,GAAIiC,EAAM6C,KACVC,KAAM9C,EAAM+C,KACZC,QAASf,EACTA,MAAOjC,EAAMA,MAAQ,MAAQA,EAAMiD,KACnCC,UAAW,GACXzF,MAAO,GACP8E,OAAQ,aACRvC,MAAOA,EAAMA,QAKhBlC,KAAKqF,SACLrF,KAAKsF,MAAMC,UAAYpB,EAEvB,GAAID,EACJ,CACCA,EAAKsB,YAAYxF,KAAKyF,YAIxBC,WAAW,WACV,GAAIzG,EAAOyD,aACX,CACCxD,GAAGsD,OAAOC,EAAyBxD,EAAOyD,aAAaC,cACvD1D,EAAOyD,aAAaE,SAAS,wBAA0BH,IAEtD,KAEHvD,GAAGE,OAAOC,KAAKC,OAAS,IAAIA,EAG5B,GAAIJ,GAAGE,OAAOuG,QAAQrG,OAAOsG,mBAC7B,CACC1G,GAAGE,OAAOuG,QAAQrG,OAAOsG,mBAAmB1G,GAAGE,OAAOC,KAAKC,UA5N5D,CA+NEL","file":""}