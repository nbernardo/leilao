function ProwebTab(){

    allTabs = "";

    this.setTabsContainer = function(id){
        allTabs = document.querySelector("#"+id).querySelectorAll("section");
        hideTabs();
        allTabs[0].style.display = "block";
    }

    this.setButtonsContainer = function(navId){

        tabBtnContainer = document.querySelector('.'+navId);
        tabs = tabBtnContainer.getElementsByTagName("div");
        for(tab of tabs){
            let curId = tab.dataset.tab;
            let clickEvent = tab.dataset.click;
            tab.onclick = function(){

                if(clickEvent != undefined){
                    eval(clickEvent);
                }


                selectTab(curId,tabs);
            }
        }
    
    }

    selectTab = function(id,tabsBtn){

        allTabs.forEach(
            (tab,index) => {
                if(tab.id != id){
                    tab.style.display = "none";
                    tabsBtn[index].setAttribute("class","tab");
                } 
                     
                else{
                    tab.style.display = "block";
                    tabsBtn[index].setAttribute("class","tab active");
                }
                    
            }
        );
    }

    hideTabs = function(){

        allTabs.forEach(
            (tab) => {
                tab.style.display = "none"; 
            }
        );

    }

    return this;


}