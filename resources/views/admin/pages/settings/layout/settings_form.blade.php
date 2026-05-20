<div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">

            </div>
        </div>
        <div class="p-6">

                <a  href="{{ route('password_reset.view') }}" class="btn bg-success text-white">Réinitialiser son mot de passe</a>


        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h4 class="card-title">Changer l'email</h4>
            </div>
        </div>
        @if ($errors->any())
        <div class="bg-danger/25 text-danger text-sm rounded-md p-4 mb-7 ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
<div class="bg-success/25 text-success text-sm rounded-md p-4 mb-7">{{ session('success') }}</div>
  @endif
        <div class="p-6">
            <form class="flex flex-col gap-3" action="{{ route('dashboard.settings.update.email') }}" method="POST">
                @csrf
                <div class="grid grid-cols-12 items-center gap-6">
                    <label for="inputEmail3" class="text-gray-800 text-sm font-medium inline-block mb-2">Ancien Email</label>
                    <div class="md:col-span-3">
                        <input type="email" class="form-input" id="inputEmail3" placeholder="Email" name="old_email" required>
                    </div>
                </div>
                <div class="grid grid-cols-12 items-center gap-6">
                    <label for="inputEmail4" class="text-gray-800 text-sm font-medium inline-block mb-2">Nouveau Email</label>
                    <div class="md:col-span-3">
                        <input type="email" class="form-input" id="inputEmail4" placeholder="Email" name="new_email" required>
                    </div>
                </div>
                <div class="grid grid-cols-12  items-center gap-6">
                    <label for="inputEmail5" class="text-gray-800 text-sm font-medium inline-block mb-2">Confirmer nouveau</label>
                    <div class="md:col-span-3">
                        <input type="email" class="form-input" id="inputEmail5" placeholder="Email" name="new_email2" required>
                    </div>
                </div>
                <div class="grid grid-cols-12  items-center gap-6">
                    <label for="inputPassword3" class="text-gray-800 text-sm font-medium inline-block mb-2">Mot de passe</label>
                    <div class="md:col-span-3">
                        <input type="password" class="form-input" id="inputPassword3" placeholder="Password" name="password" required>
                    </div>
                </div>

                <div class="grid grid-cols-12  items-center gap-6 mt-2">
                    <div class="md:col-span-3">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" class="form-checkbox rounded border border-gray-200" id="checkmeout" required name="check">
                            <label class="text-gray-800 text-sm font-medium inline-block" for="checkmeout">Je confirme que je veux modifier</label>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12  items-center gap-6 mt-4">
                    <div class="md:col-span-2">
                        <button type="submit" class="btn bg-success text-white">Changer</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
