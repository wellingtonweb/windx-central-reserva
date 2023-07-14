const Amagiloader_ = {
    __loader: null,
    show: function () {

        if (this.__loader == null) {
            var divContainer = document.createElement('div');
            // divContainer.style.position = 'fixed';
            divContainer.style.display = 'flex';
            // divContainer.style.left = '0';
            // divContainer.style.top = '0';
            divContainer.style.width = '100%';
            divContainer.style.height = '100%';
            divContainer.style.flexDirection = 'row';
            divContainer.style.justifyContent = 'center';
            divContainer.style.alignItems = 'center';
            divContainer.style.backgroundColor = 'rgba(23, 31, 48, 1)';
            // divContainer.style.backgroundColor = 'rgba(250, 250, 250, 1)';

            var div = document.createElement('div');
            div.style.position = 'absolute';
            div.style.left = '50%';
            div.style.top = '50%';
            div.style.zIndex = '9999';
            div.style.height = '64px';
            div.style.width = '64px';
            // div.style.margin = '-76px 0 0 -76px';
            div.style.margin = '0 auto';
            div.style.border = '8px solid #e1e1e1';
            div.style.borderRadius = '50%';
            div.style.borderTop = '8px solid #F36E21';
            div.animate([
                { transform: 'rotate(0deg)' },
                { transform: 'rotate(360deg)' }
            ], {
                duration: 2000,
                iterations: Infinity
            });
            divContainer.appendChild(div);
            this.__loader = divContainer
            document.body.appendChild(this.__loader);
        }
        this.__loader.style.display="";
    },
    hide: function(){
        if(this.__loader!=null)
        {
            this.__loader.style.display="none";
        }
    }
}
