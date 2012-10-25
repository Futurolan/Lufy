<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
    new TWTR.Widget({
        version: 2,
        type: 'profile',
        rpp: 5,
        interval: 6000,
        width: 'auto',
        height: 300,
        theme: {
            shell: {
                background: '#ffffff',
                color: '#000000'
            },
            tweets: {
                background: '#ffffff',
                color: '#333333',
                links: '#365d81'
            }
        },
        features: {
            scrollbar: false,
            loop: false,
            live: false,
            hashtags: true,
            timestamp: true,
            avatars: false,
            behavior: 'all'
        }
    }).render().setUser('GamersAssembly').start();
</script>