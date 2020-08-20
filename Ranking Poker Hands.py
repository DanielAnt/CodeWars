# https://www.codewars.com/kata/5739174624fc28e188000465


Straight = "2345A,23456789TJQKA"




class PokerHand(object):


    def __init__(self, hand):
        self.hand = hand
        pass
        
    def compare_with(self, other):
        RESULT = ["Loss", "Tie", "Win"]

        mySet,myMainCard, mySupCard, myComb = self.analize_hand(self.hand)
        opSet,opMainCard, opSupCard, opComb = self.analize_hand(other.hand)
        
        #DRAWS
        if mySet == opSet:
            
            if myMainCard > opMainCard:
                return RESULT[2]
            
            elif myMainCard < opMainCard:
                return RESULT[0]
            
            elif myMainCard == opMainCard:
                if mySupCard == opSupCard:
                    for num in range(4,-1,-1):
                        if self.card_to_number(myComb[num]) > self.card_to_number(opComb[num]):
                            return RESULT[2]
                        elif self.card_to_number(myComb[num]) < self.card_to_number(opComb[num]):
                            return RESULT[0]
                    return RESULT[1]
                elif mySupCard > opSupCard:
                    return RESULT[2]
                
                elif mySupCard < opSupCard:
                    return RESULT[0]
        #LOSE        
        if mySet < opSet:
            return RESULT[0]
        
        #WIN
        if mySet > opSet:
            return RESULT[2]
        
        
    def card_to_number(self,card):
            dic = {
                "2":2,
                "3":3,
                "4":4,
                "5":5,
                "6":6,
                "7":7,
                "8":8,
                "9":9,
                "T":10,
                "J":11,
                "Q":12,
                "K":13,
                "A":14
            }
            return dic[card]    
          
        
        
        
    def analize_hand(self,hand):
        color = False
        soloCards = []
        pairs = []
        triplets = []
        quads = []
        
        colors = {
            "S":0,
            "H":0,
            "D":0,
            "C":0
         }
        myFigurs = {
            '2':0,
            '3':0,
            '4':0,
            '5':0,
            '6':0,
            '7':0,
            '8':0,
            '9':0,
            'T':0,
            'J':0,
            'Q':0,
            'K':0,
            'A':0
        }
        myFigures = {}
        comb=""
        myHand = hand.split(" ")
        
        for hand in myHand:
            colors[hand[1]] += 1
            if colors[hand[1]] == 5:
                color = True
            myFigurs[hand[0]] += 1
        
        for cardValue, figur in enumerate(myFigurs):
            if myFigurs[figur] > 0:
                comb += figur*myFigurs[figur]
                highestCard = cardValue
                
                
        ### STRAIGHT ########        
        if comb in Straight:
            if color == True:
                if "2345A" == comb:
                    highestCard = 5
                return 8, highestCard, self.card_to_number(comb[3]), comb
            else:
                if "2345A" == comb:
                    highestCard = 5
                return 4, highestCard, self.card_to_number(comb[3]), comb
            
        ##### COLOR ######    
        if color == True:
            return 5, highestCard, self.card_to_number(comb[3]), comb
        
        
        ##QUADS,FULL,3 OF A KIND,PAIRS#####
        myFigurs = {k: v for k, v in myFigurs.items() if v}
        
        for figur in myFigurs:
            if myFigurs[figur] == 4:
                quads.append(figur)
                continue
            if myFigurs[figur] == 3:
                triplets.append(figur)
                continue
            if myFigurs[figur] == 2:
                pairs.append(figur)
                continue
            if myFigurs[figur] == 1:
                soloCards.append(figur)
                continue
                
                
                
        if len(quads) == 1:
            return 7, self.card_to_number(quads[0]), self.card_to_number(soloCards[0]), comb
        
        if len(triplets) == 1:
            if len(pairs) > 0:
                return 6, self.card_to_number(triplets[0]), self.card_to_number(pairs[0]), comb
            else:
                return 3, self.card_to_number(triplets[0]), highestCard , comb
            
            
        if len(pairs) > 0:
            if len(pairs) == 2:
                return 2, self.card_to_number(pairs[0]), self.card_to_number(pairs[1]), comb
            else:
                return 1, self.card_to_number(pairs[0]), highestCard, comb
        
        
        
        return 0, highestCard, self.card_to_number(comb[3]), comb
                
        
        
