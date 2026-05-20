<div class="container margin_60_40">
    <h5 class="mb_5">Écrivez-nous</h5>
    <div class="row">

        <div class="col-lg-4 col-md-6 add_bottom_25">
            @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="" style="color: green">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="" style="color: red">{{ session('error') }}</div>
    @endif
            <div id="message-contact"></div>
            <form method="post" action="{{ route('landing.contact.post') }}"  autocomplete="off">
                @csrf
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Nom" id="name_contact" name="name" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" placeholder="Email" id="email_contact" name="email" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" style="height: 150px;" placeholder="Message" id="message_contact" name="message" required></textarea>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" id="verify_contact" name="calcul" placeholder="Êtes-vous un humain ? 7 + 1 =" required>
                </div>
                <div class="form-group">
                    <input class="btn_1 full-width" type="submit" value="Envoyer">
                </div>
        </div>
        </form>
        <div class="col-lg-8 col-md-6 add_bottom_25">
            <iframe class="map_contact" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d186462.05964035765!2d6.135938169174181!3d43.09464342040819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c923a2707e1cef%3A0x69c1ae211f94ed6b!2zSHnDqHJlcywgRnJhbmNl!5e0!3m2!1sfr!2sbj!4v1724687204787!5m2!1sfr!2sbj" allowfullscreen></iframe>
        </div>
    </div>
    <!-- /row -->
</div>
