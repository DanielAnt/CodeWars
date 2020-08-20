# https://www.codewars.com/kata/5a3cbf29ee1aae06160000c9


def puzzle_fighter(ar):
    iteration = 0
    nextMove = True
    gameGrid = {}
    for x in range(12):
        for y in range(6):
            gameGrid[x,y] = " "
    for step in ar:
        block, moves = step
        if nextMove == True:
            iteration += 1
            gameGrid, nextMove = turn(gameGrid,block,moves)
        else:
            break
                
    string=""
    for x in range(12):
        for y in range(6):
            if len(gameGrid[x,y]) > 1:
                string += gameGrid[x,y][-1]
            else:
                string += gameGrid[x,y]
        string += "\n"
    return string[:-1]

        
        

def turn(gameGrid,block,moves):
    rotates  = [[0,1],[-1,0],[0,-1],[1,0]]
    x,y = 0, 3
    x1,y1 = 1, 3
    
    for move in moves:
        if move == "L":
            if 0 <= (y - 1) < 6 and 0 <= (y1 - 1) < 6:
                y -= 1
                y1 -= 1
        
        elif move == "R":
            if 0 <= (y + 1) < 6 and 0 <= (y1 + 1) < 6:
                y += 1
                y1 += 1
        
        elif move == "A":
            for index,[xPos,yPos] in enumerate(rotates):
                if x1 == x+xPos and y1 == y+yPos:
                    xDir, yDir = rotates[(index+1)%4]
                    if 0 <= y1+yDir < 6:
                        x1 = x + xDir
                        y1 = y + yDir
                    else:
                        x1 = x
                        y1 = y
                        y -= yDir
                    break
                           
        elif move == "B":
            for index,[xPos,yPos] in enumerate(rotates[::-1]):
                if x1 == x + xPos and y1 == y + yPos:
                    xDir, yDir = rotates[::-1][(index+1)%4]
                    if 0 <= y1+yDir < 6:
                        x1 = x + xDir
                        y1 = y + yDir
                    else:
                        x1 = x
                        y1 = y
                        y -= yDir
                    break
    gameGridCopy = gameGrid.copy()
    gameGrid,nextMove = fall(gameGrid,x, y, x1, y1,block[0],block[1])
    
    if nextMove == False:
        return gameGridCopy, False
    
       
    return gameGrid, True
        

def fall(gameGrid,x,y,x1,y1,color,color1):
    for block in sorted([[x,y,color],[x1,y1,color1]], key = lambda x: x[0], reverse = True):
        chosenX, chosenY, chosenCol = block
        for num in range(13):
            if chosenX == -1:
                chosenX += 1
            try:
                if gameGrid[chosenX + num,chosenY] != " ":
                    break
            except:
                break
        
        chosenX = chosenX + num - 1
        if chosenX < 0:
            return gameGrid, False    
        
        gameGrid[chosenX,chosenY] = chosenCol

    while True:
        gameGridCopy = gameGrid.copy()
        gameGrid = pre_destroy(gameGrid)
        gameGrid = join_blocks(gameGrid)
        gameGrid = expand_blocks(gameGrid)
        while True:
            temp = gameGrid.copy()
            gameGrid = move_down_whole_board(gameGrid)
            gameGrid = pre_destroy(gameGrid)
            if gameGrid == temp:
                break
        if gameGridCopy == gameGrid:
            break

    return gameGrid, True
            

def destroy_blocks(startX,startY,color,gameGrid):
    if color != "0":
        listToDestroy = [[startX,startY]]
        visited = [[startX,startY]]
        while True:
            try:
                x, y = listToDestroy.pop(0)
            except:
                break
            for x1,y1 in (x+1,y),(x-1,y),(x,y+1),(x,y-1):
                if 0 <= x1 < 12 and 0 <= y1 < 6:
                    if color.upper() in gameGrid[x1,y1].upper() and [x1,y1] not in visited:
                        listToDestroy.append([x1,y1])
                        visited.append([x1,y1])
        if len(visited) > 1:
            for x,y in visited:
                gameGrid[x,y] = " "
    else:
        if startX == 11:
            gameGrid[startX,startY] = " "
        else:
            color = gameGrid[startX+1,startY][-1].upper()
            gameGrid[startX,startY] = " "
            for x in range(12):
                for y in range(6):
                    if gameGrid[x,y][-1].upper() == color:
                        gameGrid[x,y] = " "
    return gameGrid
                    
            
def pre_destroy(gameGrid):
    
    destructors = {}
    for x in range(12):
        for y in range(6):
            if gameGrid[x,y] in "rgby0":
                destructors[x,y] = gameGrid[x,y]
    
    for [x,y], block in destructors.items():
        if block == "0":
            gameGrid = destroy_blocks(x,y,block,gameGrid)
        else:
            for x1,y1 in (1,0),(0,-1),(0,1),(-1,0):
                if 0 <= x+x1 < 12 and 0 <= y+y1 < 6:
                    if block.upper() in gameGrid[x+x1,y+y1][-1].upper():
                        gameGrid = destroy_blocks(x,y,block.upper(),gameGrid)

                    
    return gameGrid
                    
def expand_blocks(gameGrid):        
    visited = []                    
    for x in range(12):
        for y in range(6):
            if gameGrid[x,y] not in "0rgbyRGBY ":
                x, y, x1, y1, color = gameGrid[x,y].split(",")
                x = int(x)
                y = int(y)
                x1 = int(x1)
                y1 = int(y1)
                width = y1 - y + 1
                height = x1 - x + 1
                if [x,y] in visited:
                    break
                visited.append([x,y])
                
                # LEFT
                leftDY = 0
                keepLooping = True
                while keepLooping:
                    keepLooping = False
                    k = 0
                    leftDY += 1
                    for dx in range(x,x1+1):
                        if 0 <= y-leftDY and dx < 12:
                            if color in gameGrid[dx,y-leftDY]:
                                if len(gameGrid[dx,y-leftDY]) == 1:
                                    k += 1
                                else:
                                    neX, neY, neX1, neY1, color = gameGrid[dx,y-leftDY].split(",")
                                    neX = int(neX)
                                    neY = int(neY)
                                    neX1 = int(neX1)
                                    neY1 = int(neY1)
                                    neHeight = abs(neX1 - neX) + 1
                                    neWidth =  abs(neY1 - neY) + 1
                                    if neHeight == height and neX == x:
                                        leftDY += neWidth - 1
                                        if dx == x1:
                                            leftDY += 1
                                        k = height
                                        break
                    if k >= height:
                        keepLooping = True
                        
                #RIGHT        
                rightDY = 0
                keepLooping = True
                while keepLooping:
                    keepLooping = False
                    k = 0
                    rightDY += 1
                    for dx in range(x,x1+1):
                        if y1 + rightDY < 6 and dx < 12:
                            if color in gameGrid[dx,y1 + rightDY]:
                                if len(gameGrid[dx,y1 + rightDY]) == 1:
                                    k += 1
                                else:
                                    neX, neY, neX1, neY1, color = gameGrid[dx,y1 + rightDY].split(",")
                                    neX = int(neX)
                                    neY = int(neY)
                                    neX1 = int(neX1)
                                    neY1 = int(neY1)
                                    neHeight = abs(neX1 - neX) + 1
                                    neWidth =  abs(neY1 - neY) + 1
                                    if neHeight == height and neX == x:
                                        rightDY += neWidth - 1
                                        if dx == x1:
                                            rightDY += 1
                                        k = height
                                        break
                    if k >= height:
                        keepLooping = True
                
                
                #UP
                upDX = 0
                keepLooping = True
                while keepLooping:
                    keepLooping = False
                    k = 0
                    upDX += 1
                    for dy in range(y,y1+1):
                        if 0 <= x - upDX:
                            if color in gameGrid[x - upDX,dy]:
                                if len(gameGrid[x - upDX,dy]) == 1:
                                    k += 1
                                else:
                                    neX, neY, neX1, neY1, color = gameGrid[x - upDX,dy].split(",")
                                    neX = int(neX)
                                    neY = int(neY)
                                    neX1 = int(neX1)
                                    neY1 = int(neY1)
                                    neHeight = abs(neX1 - neX) + 1
                                    neWidth =  abs(neY1 - neY) + 1
                                    if neWidth == width and neY == y:
                                        upDX += neHeight - 1
                                        if dy == y1:
                                            upDX += 1
                                        k = width
                                        break
                    if k >= width:
                        keepLooping = True
                
                
                #DOWN        
                downDX = 0
                keepLooping = True
                while keepLooping:
                    keepLooping = False
                    k = 0
                    downDX += 1
                    for dy in range(y,y1+1):
                        if x1 + downDX < 12:
                            if color in gameGrid[x1 + downDX,dy]:
                                if len(gameGrid[x1 + downDX,dy]) == 1:
                                    k += 1
                                else:
                                    neX, neY, neX1, neY1, color = gameGrid[x1 + downDX,dy].split(",")
                                    neX = int(neX)
                                    neY = int(neY)
                                    neX1 = int(neX1)
                                    neY1 = int(neY1)
                                    neHeight = abs(neX1 - neX) + 1
                                    neWidth =  abs(neY1 - neY) + 1
                                    if neWidth == width and neY == y:
                                        downDX += neHeight - 1
                                        if dy == y1:
                                            downDX += 1
                                        k = width
                                        break
                    if k >= width:
                        keepLooping = True
                        
                        
                        
                downDX = downDX - 1
                upDX = upDX - 1
                leftDY = leftDY - 1
                rightDY = rightDY - 1
                horizontalGrowth = (leftDY + rightDY) * height
                verticalGrowth = (downDX + upDX) * width
                
                if leftDY > 0 or rightDY > 0 or downDX > 0 or upDX > 0:
                    
                    if verticalGrowth > horizontalGrowth:
                        x = x - upDX
                        x1 = x1 + downDX
                        for dx in range(x,x1+1):
                            for dy in range(y,y1+1):
                                gameGrid[dx,dy] = "{},{},{},{},{}".format(x,y,x1,y1,color)

                    else:
                        y = y - leftDY
                        y1 = y1 + rightDY
                        for dx in range(x,x1+1):
                            for dy in range(y,y1+1):
                                gameGrid[dx,dy] = "{},{},{},{},{}".format(x,y,x1,y1,color)
                                
    return gameGrid
                
def join_blocks(gameGrid):
    
    for color in "RGBY":
        row = {
        0 : 0,
        1 : 0,
        2 : 0,
        3 : 0,
        4 : 0,
        5 : 0,
        6 : 0,
        7 : 0,
        8 : 0,
        9 : 0,
        10 : 0,
        11 : 0       
        }
        biggestRectanglePos = []
        biggestRectangleSize = 0
        for y in range(6):
            for x in range(12):
                if gameGrid[x,y] == color:
                    row[x] += 1
                else:
                    row[x] = 0
            
            maxValue = max(row.values())
            rectangleSize = 0
            pos = []
            if maxValue > 1:
                for maxWidth in range(2,maxValue+1):
                    for col,width in row.items():
                        if width >= maxWidth:
                            pos.append([col,y])
                            rectangleSize += maxWidth
                            if len(pos) > 1 and rectangleSize > biggestRectangleSize:
                                biggestRectanglePos = pos.copy()
                                biggestRectangleSize = rectangleSize
                            elif pos != biggestRectanglePos and rectangleSize == biggestRectangleSize and len(pos) > len(biggestRectanglePos):
                                biggestRectanglePos = pos.copy()
                                
                                
                        else:                            
                            pos = []
                            rectangleSize = 0
        if biggestRectangleSize > 0:
            height = len(biggestRectanglePos)
            width = int(biggestRectangleSize / height)
            startX, startY = biggestRectanglePos[0]
            startY -= width - 1
            
            endX, endY = biggestRectanglePos[-1]
            for x,y in biggestRectanglePos:
                for dy in range(width):
                    gameGrid[x,y-dy] = "{},{},{},{},{}".format(startX,startY,endX,endY,color)
                    
    return gameGrid
                        

        
def move_down_whole_board(gameGrid):
    for x in range(11,-1,-1):
        for y in range(6):
            if gameGrid[x,y] == " ":
                for x1 in range(x-1,-1,-1):
                    if gameGrid[x1,y] != " ":
                        if len(gameGrid[x1,y]) > 1:
                            startX, startY, endX, endY, color = gameGrid[x1,y].split(",")
                            startX = int(startX)
                            startY = int(startY)
                            endX = int(endX)
                            endY = int(endY)
                            height = (endX - startX)
                            fallDawn = True
                            for  dx in range(endX,x + 1):
                                for dy in range(startY,endY + 1):
                                    if 0 <= dx < 12 and 0 <= dy < 6:
                                        if gameGrid[dx,dy] != " ":
                                            if gameGrid[dx,dy] != gameGrid[x1,y]:
                                                fallDawn = False
                                                break
                            if fallDawn == True:
                                temp = gameGrid.copy()
                                for dx in range(startX,endX+1):
                                    for dy in range(startY,endY+1):
                                        gameGrid[dx,dy] = " "
                                shift = x - endX
                                for dx in range(x - height,x+1):
                                    for dy in range(startY,endY+1):
                                        gameGrid[dx,dy] = "{},{},{},{},{}".format(startX + shift, startY, endX + shift , endY,color)
                            break
                                
                                
                        else:
                            gameGrid[x,y] = gameGrid[x1,y]
                            gameGrid[x1,y] = " "
                            break
                
    
    
    return gameGrid
