@extends("firemoon::master")

    @section("body")

        @includeIf("firemoon::partial.navbar")

        <article class="{{style('wrapper')}}">
            <section class="manage d-flex">

                <nav class="manage-nav bg-secondary-subtle">
                    Navigator
                </nav>

                <article class="manage-body  flex-fill bg-body-secondary">
                    Body Page
                </article>
            </section>
        </article>

        @includeIf("firemoon::partial.footer")

    @endsection