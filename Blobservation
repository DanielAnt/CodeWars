
#https://www.codewars.com/kata/5abab55b20746bc32e000008

class Blobservation:
    
    def __init__(self,*args):
        self.size = []
        for arg in args:
            if 50 < arg < 8:
                raise Exception("Error")
            self.size.append(arg)
        if len(self.size) > 1:
            self.height, self.width = self.size
        else:
            self.height = self.size[0]
            self.width = self.size[0]
        
        self.blobs = []
        
    
    def populate(self,blobs):
        for value in blobs:
            print(type(value['x']),type(value['y']),type(value['size']))
            if value['x'] not in range(self.height) or value['y'] not in range(self.width) or value['size'] not in range(1,21) or type(value['x']) is bool or type(value['y']) is bool or type(value['size']) is bool:
                raise Exception("Error")
        for value in blobs:
            self.blobs.append([value['x'],value['y'],value['size']])
        self.blobs = sorted(self.blobs,  key=lambda x: (x[0],x[1]))
        self.merge(self.blobs)
    
    def move(self,moves = 1):
        print(moves,type(moves))
        if moves < 1 or type(moves) is not int:
            raise Exception("Error")
        i = 0
        while moves > i:
            if len(self.blobs) <= 1:
                break
            afterMove = []
            smallestBlobSize = min(self.blobs,key=lambda x:(x[2]))[2]
            for index, blob in enumerate(self.blobs):
                x, y, size = blob
                if size > smallestBlobSize:
                    distance = float('inf')
                    targetSize = float('-inf')
                    for index1, blob1 in enumerate(self.blobs):
                        if index == index1:
                            continue
                        else:
                            x1, y1, size1 = blob1
                            if size1 < size:
                                if max([abs(x-x1),abs(y-y1)]) < distance:
                                    try:
                                        xDir = (x1-x)/abs(x1-x)
                                    except:
                                        xDir = 0
                                    try:
                                        yDir = (y1-y)/abs(y1-y)
                                    except:
                                        yDir = 0
                                    targetX = x1
                                    targetY = y1
                                    targetSize = size1
                                    distance = max([abs(x-x1),abs(y-y1)])
                                elif max([abs(x-x1),abs(y-y1)]) == distance:
                                    if size1 > targetSize:
                                        try:
                                            xDir = (x1-x)/abs(x1-x)
                                        except:
                                            xDir = 0
                                        try:
                                            yDir = (y1-y)/abs(y1-y)
                                        except:
                                            yDir = 0
                                        targetSize = size1
                                        targetX = x1
                                        targetY = y1
                                        distance = max([abs(x-x1),abs(y-y1)])
                                    elif size1 == targetSize:
                                        if targetY >= y and y1 >= y:
                                            if x1 < targetX:
                                                try:
                                                    xDir = (x1-x)/abs(x1-x)
                                                except:
                                                    xDir = 0
                                                try:
                                                    yDir = (y1-y)/abs(y1-y)
                                                except:
                                                    yDir = 0
                                                targetSize = size1
                                                targetX = x1
                                                targetY = y1
                                                distance = max([abs(x-x1),abs(y-y1)])
                                            elif x1 == targetX and y1 < targetY and x1 < x:
                                                try:
                                                    xDir = (x1-x)/abs(x1-x)
                                                except:
                                                    xDir = 0
                                                try:
                                                    yDir = (y1-y)/abs(y1-y)
                                                except:
                                                    yDir = 0
                                                targetSize = size1
                                                targetX = x1
                                                targetY = y1
                                                distance = max([abs(x-x1),abs(y-y1)])
                                            elif x1 == targetX and y1 > targetY and x1 > x:
                                                try:
                                                    xDir = (x1-x)/abs(x1-x)
                                                except:
                                                    xDir = 0
                                                try:
                                                    yDir = (y1-y)/abs(y1-y)
                                                except:
                                                    yDir = 0
                                                targetSize = size1
                                                targetX = x1
                                                targetY = y1
                                                distance = max([abs(x-x1),abs(y-y1)])
                                            
                                                
                                        elif targetY < y and y1 < y:
                                            if x1 > targetX:
                                                try:
                                                    xDir = (x1-x)/abs(x1-x)
                                                except:
                                                    xDir = 0
                                                try:
                                                    yDir = (y1-y)/abs(y1-y)
                                                except:
                                                    yDir = 0
                                                targetSize = size1
                                                targetX = x1
                                                targetY = y1
                                                distance = max([abs(x-x1),abs(y-y1)])
                                        elif y1 >= y and targetY <= y:
                                            if x1 >= targetX:
                                                try:
                                                    xDir = (x1-x)/abs(x1-x)
                                                except:
                                                    xDir = 0
                                                try:
                                                    yDir = (y1-y)/abs(y1-y)
                                                except:
                                                    yDir = 0
                                                targetSize = size1
                                                targetX = x1
                                                targetY = y1
                                                distance = max([abs(x-x1),abs(y-y1)])
                                    else:
                                        continue
                                else:
                                    continue
                    afterMove.append([int(x+xDir),int(y+yDir),size])                
                                
                else:
                    afterMove.append([int(x),int(y),size])
            self.merge(afterMove)
            i += 1
                
    
    def merge(self,blobs):
        mergedBlobs = []
        startingLength = len(blobs)
        blobs = sorted(blobs,  key=lambda x: (x[0],x[1]))
        while True:
            try:
                blob = blobs.pop(0)
            except:
                break
            x, y, size = blob
            try:
                x1, y1, size1 = blobs[0]
            except:
                mergedBlobs.append([x,y,size])
                break
            if x == x1 and y == y1:
                mergedBlobs.append([x,y,size+size1])
                blobs.pop(0)
            else:
                mergedBlobs.append([x,y,size])
        if len(mergedBlobs) != startingLength:
            self.merge(mergedBlobs)
        else:
            self.blobs = sorted(mergedBlobs,key = lambda x: (x[0],x[1]))
        
            
            
    def draw_map(self):
        if len(self.size) > 1:
            height, width = self.size
        else:
            height = self.size[0]
            width = self.size[0]
        list = []
        dic = {}
        for blob in self.blobs:
            x, y, size = blob
            dic["{},{}".format(x,y)] = size
        
        for h in range(height):
            string = ""
            for w in range(width):
                if "{},{}".format(h,w) in dic:
                    string += str(dic["{},{}".format(h,w)]) +"  "
                else:
                    string += "-  "
            list.append(string)
            
        for row in list:
            print(row)
                
                
    def print_state(self):
        return self.blobs
