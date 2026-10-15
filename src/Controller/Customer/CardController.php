<?php

namespace App\Controller\Customer;

use App\Entity\User;
use App\Enum\CardStatusEnum;
use App\Enum\CardTypeEnum;
use App\Utils\Common;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/customer')]
final class CardController extends AbstractController
{
    private const PER_PAGE = 6;
    /**
     *  ********************GESTION DES CARTES*******************
     * */
    #[Route('/cards',  name: 'app_customer_cards')]
    public function cards(): Response
    {
        $connectedUser = $this->getUser();
        if(!$connectedUser instanceof User){
            return $this->redirectToRoute('app_logout');
        }
        $allCards = $connectedUser->getCustomer()->getCards();
        $activeCards = $allCards->filter(fn($card) => $card->getStatus() == CardStatusEnum::ACTIVATED);
        $cards = $cardTransactions = [];
        $i = 1;
        $monthlySpending = $availableCredit  = $monthlyChange = 0;
        foreach($connectedUser->getCustomer()->getCards() as $card){
            $cards[] =  [
                'id' => $i,
                'brand' => 'visa',
                'variant' => $card->getVariante(),
                'first4' =>  substr($card->getCardNumber(),0,4),
                'last4' => substr($card->getCardNumber(),-4),
                'type' => 'Débit',
                'tier' => $card->getCardType()->getLabel(),
                'availableBalance' => $card->getAmount(),
                'limitUsedPercent' => $card->getPercentUsed(),
                'gaugeColor' => $card->getGaugeColor(),
                'expiry' => $card->getExpire(),
                'locked' => false,
            ];
            $monthlySpending += $card->getAmountExpendedThisMonthly();
            foreach($card->getTransactions() as $transaction){
                $cardTransactions[] = [
                        'cardLast4' => substr($card->getCardNumber(),-4),
                        'cardBrand' => CardTypeEnum::VISA->getLabel(),
                        'cardVariant' => $card->getVariante(),
                        'date' => $transaction->getCreatedAt(),
                        'description' => $transaction->getDescription(),
                        'operation' => $transaction->getOperation(),
                        'amount' => $transaction->getAmount(),
                        'status' => $transaction->getStatus(),
                    ];
            }
        }
        $transCardType = ['TXN_115','TXN_114','TXN_116','TXN_117','TXN_118','TXN_119','TXN_120','TXN_112','TXN_113','TXN_111'];
       $cardTransactionOthers = $connectedUser->getCustomer()->getTransactions()->filter(function($trans) use($transCardType){
           return in_array($trans->getTransType()->getIconCode(), $transCardType);
        });
        return $this->render('customer/cards.html.twig', [
                // Indicateurs
                'activeCards' => count($activeCards),
                'totalCards' => count($allCards),
                'monthlySpending' => $monthlySpending,
                'availableCredit' => 12750.20,
                'monthlyChange' => 8.2,
                'cards' => $cards,
                'cardTransactionOthers' => $cardTransactionOthers,
                // Transactions par carte
                'cardTransactions' => $cardTransactions,
                'hasMoreTransactions' => count($cardTransactions) > 4,
        ]);
    }

    #[Route('/cartes/setting', name: 'app_cards_settings', methods: ['GET'])]
    public function cardSettings(): Response
    {
        return $this->render('customer/card_settingl.html.twig', [
            'pageTitle' => 'Paramètres des cartes',
        ]);
    }

    #[Route('/cartes/{id}', name: 'app_card_show', methods: ['GET'])]
    public function show(string $id): Response
    {
        return $this->render('customer/card_detail.html.twig', [
            'pageTitle' => 'Détail de la carte',
        ]);
    }

    /**
     * Blocage / déblocage d'une carte.
     *
     * En POST avec jeton CSRF : une action qui modifie l'état d'un moyen de
     * paiement ne doit jamais être déclenchable par un simple GET (un lien
     * préchargé par le navigateur suffirait à bloquer la carte du client).
     */
    #[Route('/cartes/{id}/blocage', name: 'app_card_lock', methods: ['POST'])]
    public function lock(Request $request, string $id): Response
    {
        if (!$this->isCsrfTokenValid('lock-card-'.$id, (string) $request->request->get('_token'))) {
            $this->addFlash('error', 'Requête invalide.');
            return $this->redirectToRoute('app_cards');
        }

        // TODO : basculer Card::status via CardRepository, journaliser l'action.
        $this->addFlash('success', 'Le statut de la carte a été mis à jour.');
        return $this->redirectToRoute('app_cards');
    }

    #[Route('/cartes/order', name: 'app_card_order', methods: ['GET'])]
    public function order(): Response
    {
        return $this->render('customer/card_order.html.twig', [
            'pageTitle' => 'Commander une carte',
        ]);
    }
    
}