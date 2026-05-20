<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_1">Liens rapides</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="{{ route('landing.about.accueil') }}">À propos</a></li>
                        <li><a href="{{ route('landing.contact.accueil') }}">Contact</a></li>
                        <li><a href="{{ route('landing.faq.accueil') }}">FAQ</a></li>
                        <li><a href="{{ route('register.view') }}">S'inscrire</a></li>
                        <li><a href="{{ route('join.community.view') }}">Rejoindre la communauté</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_2">Categories</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        <li><a href="{{ route('landing.events.accueil') }}">Évènements</a></li>
                        <li><a href="{{ route('landing.offers.accueil') }}">Offres Promotionnelles</a></li>
                        <li><a href="{{ route('landing.menu.accueil') }}">Menus spéciaux</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-bs-target="#collapse_3">Contacts</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        {{-- <li><i class="icon_house_alt"></i>594 Chemin de la Source 83400 Hyeres Var<br>Hyeres - FR</li> --}}
                        <li><i class="icon_mobile"></i>+330677424145</li>
                        <li><i class="icon_mail_alt"></i><a href="#0">contact@restoactif.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-bs-target="#collapse_4">Rester en contact</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <div id="message-newsletter"></div>
                        <form method="post" action="" name="newsletter_form" id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                                <button type="submit" id="submit-newsletter"><i class="arrow_carrot-right"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="follow_us">
                        <h5>Nous suivre</h5>
                        <ul>
                            <li><a href="#0"><i class="bi bi-facebook"></i></a></li>
                            <li><a href="#0"><i class="bi bi-twitter-x"></i></a></li>
                            <li><a href="#0"><i class="bi bi-instagram"></i></a></li>
                            <li><a href="#0"><i class="bi bi-tiktok"></i></a></li>
                            <li><a href="#0"><i class="bi bi-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row-->
        <hr>
        <div class="row add_bottom_25">
            <div class="col-lg-6">
                <ul class="footer-selector clearfix">
                    {{-- <li>
                        <div class="styled-select lang-selector">
                            <select>
                                <option value="English" selected>English</option>
                                <option value="French">French</option>
                                <option value="Spanish">Spanish</option>
                                <option value="Russian">Russian</option>
                            </select>
                        </div>
                    </li> --}}
                    {{-- <li>
                        <div class="styled-select currency-selector">
                            <select>
                                <option value="US Dollars" selected>US Dollars</option>
                                <option value="Euro">Euro</option>
                            </select>
                        </div>
                    </li> --}}
                    {{-- <li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/cards_all.svg" alt="" width="198" height="30" class="lazy"></li> --}}
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="additional_links">
                    {{-- <li><a href="#0">Terms and conditions</a></li> --}}
                    <li><a href="/politique-confidentialite">Politiques de confidentialités</a></li>
                    <li><span>© Restoactif</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
