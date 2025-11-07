@extends("firemoon::master")

    @section("body")

        @includeIf("firemoon::partial.header")

        @includeIf("firemoon::partial.navbar")
        
        @includeIf("firemoon::partial.trust")

        @includeIf("firemoon::partial.footer")

    @endsection

    @section("js")
        @parent <script>
            
            function heightScreen(e) {                
                jQuery(e).height(jQuery(window).height());
            }

            heightScreen(".hfull");

            
        </script>
    @endsection

         