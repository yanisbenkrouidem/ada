@extends('layouts.app')

@section('title', 'Mon Panier - Finalisation')

@section('content')
<style>
    #main-header {
        background-color: #ffffff !important;
        color: #000000 !important;
        border-bottom: 1px solid #f0f0f0;
    }
    #main-header .header-logo-img {
        filter: brightness(0) !important; /* Logo Noir */
    }
    #main-header .nav-icon {
        stroke: #000000 !important;
    }
    /* Adaptation de la barre de recherche du header */
    .nav-search-input {
        background-color: #f5f5f5 !important;
        border-color: #e5e5e5 !important;
        color: #000000 !important;
    }
    .nav-search-input::placeholder {
        color: #999999 !important;
    }
    .nav-search-icon-pos {
        color: #999999 !important;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

<div class="pt-32 pb-20 bg-white min-h-screen font-sans">
    
    <div class="max-w-[1440px] mx-auto px-6 md:px-12">
        
        <h1 class="text-2xl md:text-3xl font-light mb-12 tracking-wide">Finaliser ma commande</h1>

        @if($paniers->isEmpty())
            <div class="text-center py-20 bg-gray-50 rounded-xl">
                <p class="text-gray-500 text-lg mb-8">Votre panier est vide.</p>
                <a href="{{ route('vehicules.flotte') }}" class="inline-block bg-black text-white px-8 py-3 rounded-full text-sm font-medium">Découvrir la flotte</a>
            </div>
        @else
            
            <div class="flex flex-col lg:flex-row gap-16 relative">
                
                <div class="flex-1 flex flex-col gap-10">
                    
                    @foreach($paniers as $index => $item)
                        <div class="flex flex-col md:flex-row gap-8 pb-10 border-b border-gray-100 cart-item" 
                             data-price="{{ $item->vehicule->category->tarifjournee ?? 50 }}">
                            
                            <div class="w-full md:w-[280px] h-[280px] bg-[#f6f5f3] flex items-center justify-center p-6 relative">
                                @php
                                    // --- LOGIQUE IMAGE SQL ADAPTÉE ---
                                    // Vérifie d'abord l'image du véhicule, sinon celle de la catégorie
                                    $photoName = !empty($item->vehicule->image) ? $item->vehicule->image : ($item->vehicule->category->photo ?? 'voiture.png');
                                    $photoUrl = asset('images/' . $photoName);
                                @endphp
                                <img src="{{ $photoUrl }}" class="max-w-full max-h-full object-contain mix-blend-multiply" alt="Voiture">
                            </div>

                            <div class="flex-1 pt-2 flex flex-col">
                                <div class="flex justify-between items-start mb-2">
                                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">{{ $item->vehicule->category->libelle ?? 'Premium' }}</p>
                                    
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{$item->id}}').submit();" class="text-gray-400 hover:text-red-600 transition">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                    <form id="delete-form-{{$item->id}}" action="{{ route('panier.delete', $item->id) }}" method="POST" style="display: none;">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>

                                <h2 class="text-xl font-normal text-black mb-1">{{ $item->vehicule->marque }} {{ $item->vehicule->modele }}</h2>
                                <p class="text-sm text-gray-500 mb-6">{{ $item->vehicule->immat }}</p>

                                <div class="mt-auto flex justify-between items-end">
                                    <div class="text-xs text-gray-500">
                                        Tarif journalier : <span class="font-bold text-black">{{ number_format($item->vehicule->category->tarifjournee ?? 50, 2) }}€</span>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-400 mb-1">Total pour ce véhicule</p>
                                        <span class="text-xl font-normal item-total-display text-gray-300">-- €</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4 border border-gray-100 p-6 rounded-lg flex gap-4 items-center bg-gray-50/50">
                        <i class="fa-solid fa-shield-halved text-2xl text-black"></i>
                        <div>
                            <p class="font-medium text-sm">Assurance Standard Incluse</p>
                            <p class="text-xs text-gray-500">Couverture responsabilité civile et dommages collisions.</p>
                        </div>
                    </div>

                </div>

                <div class="lg:w-[420px] mt-10 lg:mt-0">
                    
                    <form action="/panier/valider" method="POST" id="checkout-form">
                        @csrf
                        
                        <div class="sticky top-32 bg-[#f6f5f3] p-8 rounded-2xl">
                            
                            <h3 class="text-lg font-normal mb-6 border-b border-gray-200 pb-4">Détails de la réservation</h3>

                            <div class="space-y-4 mb-8">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Départ</label>
                                    <input type="text" id="start_date" name="date_depart" required 
                                           class="w-full bg-white border border-gray-200 p-3 rounded text-sm focus:outline-none focus:border-black transition"
                                           placeholder="Date de départ...">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Retour</label>
                                    <input type="text" id="end_date" name="date_retour" required 
                                           class="w-full bg-white border border-gray-200 p-3 rounded text-sm focus:outline-none focus:border-black transition"
                                           placeholder="Date de retour...">
                                </div>
                                <div class="flex justify-between text-xs text-gray-600 pt-2">
                                    <span>Durée :</span>
                                    <span id="duration-display" class="font-bold text-gray-400">--</span>
                                </div>
                            </div>

                            <h3 class="text-lg font-normal mb-6 border-b border-gray-200 pb-4 pt-4">Paiement</h3>
                            
                            <div class="space-y-3 mb-8">
                                <div class="relative">
                                    <input type="text" id="card_number" name="card_number" maxlength="19" inputmode="numeric" placeholder="Numéro de carte" class="w-full bg-white border border-gray-200 p-3 pl-10 rounded text-sm focus:outline-none focus:border-black transition font-mono">
                                    <i class="fa-regular fa-credit-card absolute left-3 top-3.5 text-gray-400"></i>
                                </div>
                                <div class="flex gap-3">
                                    <input type="text" id="card_expiry" name="expiry" maxlength="5" inputmode="numeric" placeholder="MM/YY" class="w-1/2 bg-white border border-gray-200 p-3 rounded text-sm focus:outline-none focus:border-black text-center transition font-mono">
                                    <input type="text" id="card_cvc" name="cvc" maxlength="3" inputmode="numeric" placeholder="CVC" class="w-1/2 bg-white border border-gray-200 p-3 rounded text-sm focus:outline-none focus:border-black text-center transition font-mono">
                                </div>
                            </div>

                            <div class="flex justify-between items-center mb-8 pt-4 border-t border-gray-300">
                                <span class="text-lg font-normal">Total à payer</span>
                                <span class="text-2xl font-bold" id="grand-total-display">0,00€</span>
                                <input type="hidden" name="total_amount" id="total_amount_input" value="0">
                            </div>

                            <button type="submit" id="btn-submit" disabled 
                                    class="w-full bg-black text-white py-4 rounded-full font-medium text-sm hover:opacity-80 transition opacity-50 cursor-not-allowed flex justify-center items-center gap-2">
                                <span>Sélectionnez vos dates</span>
                            </button>

                            <p class="text-[10px] text-gray-400 text-center mt-4">
                                Paiement sécurisé via Stripe/PayPal.
                            </p>

                        </div>
                    </form>
                </div>

            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // --- FORMATAGE INPUTS ---
        const cardInput = document.getElementById('card_number');
        const expiryInput = document.getElementById('card_expiry');
        const cvcInput = document.getElementById('card_cvc');

        if(cardInput) {
            cardInput.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '').substring(0, 16); 
                e.target.value = value.match(/.{1,4}/g)?.join(' ') || value;
            });
        }

        if(expiryInput) {
            expiryInput.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, ''); 
                if (value.length >= 2) value = value.substring(0, 2) + '/' + value.substring(2, 4);
                e.target.value = value;
            });
        }

        if(cvcInput) {
            cvcInput.addEventListener('input', function (e) {
                e.target.value = e.target.value.replace(/\D/g, '').substring(0, 3);
            });
        }

        // --- CALCUL PRIX ---
        const items = document.querySelectorAll('.cart-item');
        const displayTotal = document.getElementById('grand-total-display');
        const displayDuration = document.getElementById('duration-display');
        const submitBtn = document.getElementById('btn-submit');
        const btnSpan = submitBtn.querySelector('span');
        const totalInput = document.getElementById('total_amount_input');

        const config = { 
            enableTime: true, 
            dateFormat: "Y-m-d H:i", 
            time_24hr: true, 
            minDate: "today", 
            locale: "fr",
            onChange: calculateTotal
        };

        const fpStart = flatpickr("#start_date", {
            ...config,
            onChange: function(selectedDates, dateStr, instance) {
                fpEnd.set('minDate', dateStr);
                calculateTotal();
            }
        });
        
        const fpEnd = flatpickr("#end_date", config);

        function calculateTotal() {
            const startStr = document.getElementById('start_date').value;
            const endStr = document.getElementById('end_date').value;

            if (startStr && endStr) {
                const start = new Date(startStr);
                const end = new Date(endStr);
                const diffTime = end - start;
                
                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                if (diffDays <= 0) diffDays = 1;

                displayDuration.innerText = diffDays + (diffDays > 1 ? " Jours" : " Jour");
                displayDuration.classList.remove('text-gray-400');
                displayDuration.classList.add('text-black');

                let grandTotal = 0;

                items.forEach(item => {
                    const pricePerDay = parseFloat(item.getAttribute('data-price'));
                    const itemTotal = pricePerDay * diffDays;
                    
                    const itemDisplay = item.querySelector('.item-total-display');
                    if(itemDisplay) {
                        itemDisplay.innerText = itemTotal.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + "€";
                        itemDisplay.classList.remove('text-gray-300');
                        itemDisplay.classList.add('text-black');
                    }
                    
                    grandTotal += itemTotal;
                });

                displayTotal.innerText = grandTotal.toLocaleString('fr-FR', {minimumFractionDigits: 2}) + "€";
                totalInput.value = grandTotal;

                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                btnSpan.innerText = "Confirmer la réservation";
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                btnSpan.innerText = "Sélectionnez vos dates";
            }
        }
    });
</script>
@endsection
