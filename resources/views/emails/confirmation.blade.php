<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation ADA Location</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ada.png') }}">
    <style>
        /* RESET & BASE */
        body { margin: 0; padding: 0; background-color: #F4F5F9; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; }
        table { border-spacing: 0; width: 100%; }
        td { padding: 0; }
        img { border: 0; }
        
        /* STYLES PRINCIPAUX */
        .wrapper { width: 100%; table-layout: fixed; background-color: #F4F5F9; padding-bottom: 40px; }
        .main-table { background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 600px; border-spacing: 0; font-family: sans-serif; color: #333333; box-shadow: 0 10px 40px rgba(0,0,0,0.08); border-radius: 16px; overflow: hidden; }
        
        /* HEADER AVEC TON GRADIENT ADA SPÃ‰CIFIQUE */
        .header { 
            background: linear-gradient(135deg, #990033 0%, #5C0632 60%, #2E0219 100%); 
            padding: 40px 40px; 
            text-align: center; 
        }
        
        .content { padding: 40px; }
        .footer { background-color: #F4F5F9; padding: 20px; text-align: center; font-size: 11px; color: #888888; }
        
        /* TYPOGRAPHIE */
        h1 { margin: 0 0 10px 0; color: #111111; font-size: 22px; font-weight: 700; letter-spacing: -0.5px; }
        .subtitle { font-size: 13px; color: #990033; text-transform: uppercase; letter-spacing: 2px; font-weight: bold; margin-bottom: 25px; display: block; }
        p { margin: 0 0 15px 0; font-size: 15px; line-height: 1.6; color: #555555; }
        
        /* BOUTON D'ACTION */
        .btn { 
            display: inline-block; 
            background: linear-gradient(135deg, #990033 0%, #5C0632 60%, #2E0219 100%);
            color: #ffffff; 
            text-decoration: none; 
            padding: 14px 35px; 
            border-radius: 50px; 
            font-size: 13px; 
            font-weight: bold; 
            margin-top: 25px; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            box-shadow: 0 4px 15px rgba(153, 0, 51, 0.2);
        }
        
        /* CARTE DE MEMBRE VIRTUELLE */
        .virtual-card {
            background: linear-gradient(135deg, #222 0%, #111 100%); /* Fond sombre premium */
            color: white;
            padding: 25px;
            border-radius: 16px;
            margin: 25px 0;
            text-align: left;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border: 1px solid rgba(255,255,255,0.1);
            overflow: hidden;
        }
        /* Effet de brillance sur la carte */
        .virtual-card::after {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(153,0,51,0.2) 0%, transparent 60%);
            pointer-events: none;
        }
        
        .card-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; position: relative; z-index: 2; }
        .card-label { font-size: 9px; text-transform: uppercase; letter-spacing: 2px; color: #888; margin-bottom: 4px; }
        .card-value { font-size: 16px; font-weight: bold; letter-spacing: 1px; color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.5); }
        
        /* DISCLAIMER PROJET */
        .project-signature {
            border-top: 1px dashed #ddd;
            margin-top: 35px;
            padding-top: 25px;
            text-align: center;
        }
        .tech-badge {
            background: #eee;
            color: #444;
            font-size: 9px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 10px;
        }
        .signature-text {
            font-size: 12px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <br>
        <table class="main-table">
            <tr>
                <td class="header">
                    <div style="font-family: 'Times New Roman', serif; color: white; font-size: 32px; letter-spacing: 2px; font-weight: bold;">ADA</div>
                    <div style="color: rgba(255,255,255,0.8); font-size: 9px; letter-spacing: 3px; text-transform: uppercase; margin-top: 5px;">Location de vÃ©hicules</div>
                </td>
            </tr>

            <tr>
                <td class="content">
                    <span class="subtitle">Notification Officielle</span>
                    <h1>Bonjour,</h1>
                    
                    <p>Nous avons bien reÃ§u votre demande concernant : <strong>{{ $contexte }}</strong>.</p>

                    @if(str_contains(strtolower($contexte), 'club'))
                        <p>Bienvenue dans le cercle privilÃ©giÃ© des conducteurs ADA. Votre adhÃ©sion au <strong>Club</strong> est confirmÃ©e. Vous bÃ©nÃ©ficiez dÃ©sormais de la prioritÃ© en agence et du surclassement offert selon disponibilitÃ©.</p>
                        
                        <div class="virtual-card">
                            <div class="card-top">
                                <span style="font-weight:bold; font-size:18px;">ADA CLUB</span>
                                <span style="font-size:9px; background:white; color:black; padding:3px 8px; border-radius:10px; font-weight:bold;">PREMIUM</span>
                            </div>
                            
                            <table style="width:100%">
                                <tr>
                                    <td>
                                        <div class="card-label">Titulaire</div>
                                        <div class="card-value">Yanis Benkrouidem</div> </td>
                                    <td style="text-align: right;">
                                        <div class="card-label">Expiration</div>
                                        <div class="card-value">12/2026</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <p style="font-size: 13px; color: #777;">PrÃ©sentez ce mail ou votre application lors de votre prochain retrait de vÃ©hicule pour activer vos avantages.</p>

                    @else
                        <p>Merci de rejoindre notre communautÃ©. Vous Ãªtes dÃ©sormais inscrit Ã  notre lettre d'information.</p>
                        <p>Soyez prÃªt Ã  partir : vous recevrez prochainement nos meilleures offres de location pour vos week-ends et dÃ©mÃ©nagements, directement dans votre boÃ®te mail.</p>
                        
                        <div style="background: #FFF0F5; border-left: 4px solid #990033; padding: 15px; margin: 20px 0; font-size: 13px; color: #5C0632;">
                            <strong>Le saviez-vous ?</strong><br>
                            En rÃ©servant 30 jours Ã  l'avance, vous Ã©conomisez en moyenne 20% sur la gamme Tourisme.
                        </div>
                    @endif

                    <div style="text-align: center;">
                        <a href="{{ url('/') }}" class="btn">Retourner sur le site</a>
                    </div>

                    <div class="project-signature">
                        <span class="tech-badge">Laravel 10 â€¢ SMTP â€¢ Mailable</span>
                        <p class="signature-text">
                            Ce courriel est une dÃ©monstration technique rÃ©alisÃ©e par <strong>Yanis Benkrouidem</strong>.<br>
                            Il s'inscrit dans le cadre du projet <strong>BTS SIO (Option SLAM)</strong> - Ã‰preuve E4.<br>
                            Aucune transaction commerciale rÃ©elle n'a Ã©tÃ© effectuÃ©e.
                        </p>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="footer">
                    <p style="margin: 0;">Â© 2025 ADA Location (Projet Ã‰tudiant). Tous droits rÃ©servÃ©s.</p>
                    <p style="margin: 5px 0 0 0; opacity: 0.6;">Ceci est un mail automatique, merci de ne pas rÃ©pondre.</p>
                </td>
            </tr>
        </table>
        <br><br>
    </div>

</body>
</html>
